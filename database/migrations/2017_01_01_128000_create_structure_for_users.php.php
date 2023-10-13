<?php

use LaravelLiberu\Migrator\Database\Migration;

return new class extends Migration
{
    protected array $permissions = [
        ['name' => 'administration.users.initTable', 'description' => 'Init table for users', 'is_default' => false],
        ['name' => 'administration.users.tableData', 'description' => 'Get table data for users', 'is_default' => false],
        ['name' => 'administration.users.exportExcel', 'description' => 'Export excel for users', 'is_default' => false],
        ['name' => 'administration.users.options', 'description' => 'Get options for select', 'is_default' => false],
        ['name' => 'administration.users.create', 'description' => 'Create user', 'is_default' => false],
        ['name' => 'administration.users.edit', 'description' => 'Edit existing user', 'is_default' => false],
        ['name' => 'administration.users.index', 'description' => 'Show users', 'is_default' => false],
        ['name' => 'administration.users.show', 'description' => 'Display user information', 'is_default' => true],
        ['name' => 'administration.users.store', 'description' => 'Store newly created user', 'is_default' => false],
        ['name' => 'administration.users.update', 'description' => 'Update edited user', 'is_default' => false],
        ['name' => 'administration.users.destroy', 'description' => 'Delete user', 'is_default' => false],

        ['name' => 'administration.users.tokens.create', 'description' => 'Create Token', 'is_default' => false],
        ['name' => 'administration.users.tokens.store', 'description' => 'Generate token for user', 'is_default' => false],
        ['name' => 'administration.users.tokens.destroy', 'description' => 'Delete token', 'is_default' => false],
        ['name' => 'administration.users.tokens.index', 'description' => 'Get Tokens', 'is_default' => false],

        ['name' => 'administration.users.sessions.destroy', 'description' => 'Delete token', 'is_default' => false],
        ['name' => 'administration.users.sessions.index', 'description' => 'Get Tokens', 'is_default' => false],

        ['name' => 'administration.users.resetPassword', 'description' => 'Manually Reset password for the user', 'is_default' => false],
    ];

    protected array $menu = [
        'name' => 'Users', 'icon' => 'user', 'route' => 'administration.users.index', 'order_index' => 100, 'has_children' => false,
    ];

    protected ?string $parentMenu = 'Administration';
};
