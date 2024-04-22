<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // We create the roles
        $admin = Role::create(['name' => 'Administrator']);
        $author = Role::create(['name' => 'Author']);
        //Permissions
        Permission::create(['name' => 'admin.index', 
                            'description' => 'See the Dashboard'])->syncRoles([$admin, $author]);
        // Categories
        Permission::create(['name' => 'categories.index', 
                            'description' => 'See the categories'])->syncRoles([$admin, $author]);
        Permission::create(['name' => 'categories.create', 
                            'description' => 'Create Categories'])->assignRole($admin);
        Permission::create(['name' => 'categories.edit', 
                            'description' => 'Edit Categories'])->assignRole($admin);
        Permission::create(['name' => 'categories.destroy', 
                            'description' => 'Delete Categories'])->assignRole($admin);
        // Articles
        Permission::create(['name' => 'articles.index', 
                'description' => 'See the articles'])->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.create', 
                        'description' => 'Create articles'])->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.edit', 
                        'description' => 'Edit articles'])->syncRoles([$admin, $author]);
        Permission::create(['name' => 'articles.destroy', 
                        'description' => 'Delete articles'])->syncRoles([$admin, $author]);
        // Comments
        Permission::create(['name' => 'comments.index', 
                'description' => 'See the comments'])->syncRoles([$admin, $author]);
        Permission::create(['name' => 'comments.destroy', 
                        'description' => 'Delete comments'])->syncRoles([$admin, $author]);
                            
        
        // Users
        Permission::create(['name' => 'users.index', 
                'description' => 'See users'])->assignRole($admin);
        Permission::create(['name' => 'users.edit', 
                'description' => 'Edit users'])->assignRole($admin);
        Permission::create(['name' => 'users.destroy', 
                'description' => 'Delete users'])->assignRole($admin);

        // Roles
        Permission::create(['name' => 'roles.index', 
                            'description' => 'See the roles'])->assignRole($admin);
        Permission::create(['name' => 'roles.create', 
                            'description' => 'Create roles'])->assignRole($admin);
        Permission::create(['name' => 'roles.edit', 
                            'description' => 'Edit roles'])->assignRole($admin);
        Permission::create(['name' => 'roles.destroy', 
                            'description' => 'Delete roles'])->assignRole($admin);
    }
}
