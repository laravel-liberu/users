<?php

namespace LaravelLiberu\Users\Models;

use Exception;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Core\Exceptions\UserConflict;
use LaravelLiberu\Core\Models\Login;
use LaravelLiberu\Core\Models\Preference;
use LaravelLiberu\Core\Services\DefaultPreferences;
use LaravelLiberu\Core\Traits\HasPassword;
use LaravelLiberu\DynamicMethods\Traits\Abilities;
use LaravelLiberu\Files\Models\File;
use LaravelLiberu\Helpers\Contracts\Activatable;
use LaravelLiberu\Helpers\Traits\ActiveState;
use LaravelLiberu\Helpers\Traits\AvoidsDeletionConflicts;
use LaravelLiberu\Helpers\Traits\CascadesMorphMap;
use LaravelLiberu\Helpers\Traits\CascadesObservers;
use LaravelLiberu\People\Models\Person;
use LaravelLiberu\People\Traits\IsPerson;
use LaravelLiberu\Rememberable\Traits\Rememberable;
use LaravelLiberu\Roles\Enums\Roles;
use LaravelLiberu\Roles\Models\Role;
use LaravelLiberu\Tables\Traits\TableCache;
use LaravelLiberu\UserGroups\Enums\UserGroups;
use LaravelLiberu\UserGroups\Models\UserGroup;
use stdClass;

class User extends Authenticatable implements Activatable, HasLocalePreference
{
    use ActiveState, AvoidsDeletionConflicts, CascadesMorphMap;
    use CascadesObservers, HasApiTokens, HasFactory, HasPassword, IsPerson;
    use Notifiable, Abilities, Rememberable, TableCache;

    protected $hidden = ['password', 'remember_token', 'password_updated_at'];

    protected $guarded = ['id', 'password'];

    protected $casts = [
        'is_active' => 'boolean', 'person_id' => 'int',
        'group_id'  => 'int', 'role_id' => 'int',
    ];

    protected $dates = ['password_updated_at'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function group()
    {
        return $this->belongsTo(UserGroup::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function files()
    {
        return $this->hasMany(File::class, 'created_by');
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function preference()
    {
        return $this->hasOne(Preference::class);
    }

    public function company(): ?Company
    {
        return $this->person->company();
    }

    public function canAccess(string $route): bool
    {
        return Role::permissionList($this->role_id)->contains($route);
    }

    public function isAdmin(): bool
    {
        return $this->role_id === App::make(Roles::class)::Admin;
    }

    public function isSupervisor(): bool
    {
        return $this->role_id === App::make(Roles::class)::Supervisor;
    }

    public function isSuperior(): bool
    {
        return $this->isAdmin() || $this->isSupervisor();
    }

    public function belongsToAdminGroup(): bool
    {
        return $this->group_id === App::make(UserGroups::class)::Admin;
    }

    public function isPerson(Person $person): bool
    {
        return $this->person_id === $person->id;
    }

    public function preferences(): stdClass
    {
        return Preference::cacheGetBy('user_id', $this->id)->value
            ?? $this->defaultPreferences()->value;
    }

    public function preferredLocale(): string
    {
        return $this->lang();
    }

    public function lang(): string
    {
        return $this->preferences()->global->lang;
    }

    public function scopeAdmins(Builder $builder): Builder
    {
        return $builder->whereRoleId(App::make(Roles::class)::Admin);
    }

    public function scopeSupervisors(Builder $builder): Builder
    {
        return $builder->whereRoleId(App::make(Roles::class)::Supervisor);
    }

    public function storeGlobalPreferences($global): void
    {
        $preferences = $this->preferences();
        $preferences->global = $global;

        $this->storePreferences($preferences);
    }

    public function storeLocalPreferences($route, $value): void
    {
        $preferences = $this->preferences();
        $preferences->local->$route = $value;

        $this->storePreferences($preferences);
    }

    public function erase(bool $person = false)
    {
        if ($person) {
            return DB::transaction(fn () => tap($this)->delete()->person->delete());
        }

        return $this->delete();
    }

    public function delete()
    {
        if ($this->logins()->exists()) {
            throw UserConflict::hasActivity();
        }

        try {
            return parent::delete();
        } catch (Exception) {
            throw UserConflict::hasActivity();
        }
    }

    public function resetPreferences(): void
    {
        $this->storePreferences($this->defaultPreferences()->value);
    }

    public function storePreferences($preferences): void
    {
        $this->preference()->updateOrCreate(
            ['user_id' => $this->id],
            ['value' => $preferences]
        );
    }

    protected function defaultPreferences(): Preference
    {
        return new Preference([
            'value' => DefaultPreferences::data(),
        ]);
    }
}
