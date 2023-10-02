<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('person_id')->unsigned()->unique();

            $table->foreignId('group_id')->constrained('user_groups')->index();

            $table->foreignId('role_id')->constrained()->index();

            $table->string('email')->unique();
            $table->string('password')->nullable();

            $table->boolean('is_active');

            $table->foreignId('created_by')->nullable()->constrained('users')->index();

            $table->foreignId('updated_by')->nullable()->constrained('users')->index();

            $table->rememberToken();

            $table->datetime('password_updated_at')->nullable();

            $table->timestamps();
        });
    }
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
