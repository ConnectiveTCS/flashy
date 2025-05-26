<?php

namespace Database\Seeders;

use App\Models\Flashcard;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Module;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'add flashcards']);
        Permission::create(['name' => 'edit flashcards']);
        Permission::create(['name' => 'delete flashcards']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'student']);
        $role1->givePermissionTo('add flashcards');
        $role1->givePermissionTo('edit flashcards');
        $role1->givePermissionTo('delete flashcards');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('add flashcards');
        $role2->givePermissionTo('edit flashcards');
        $role2->givePermissionTo('delete flashcards');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@acewebdesign.co.za',
            'password' => bcrypt('Morgan146@'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Student Test',
            'email' => 'student@test.com',
            'password' => bcrypt('Morgan146@'),
        ]);
        $user->assignRole($role1);

        // Create Modules
        Module::factory()->count(5)->create()->each(function ($module) {
            $module->user_id = 1; // Assign the user ID to the module
            $module->save();
        });
        // Create Topics
        Topic::factory()->count(10)->create()->each(function ($topic) {
            $topic->user_id = 1; // Assign the user ID to the topic
            $topic->save();
        });

        Flashcard::factory(50)->create()->each(function ($flashcard) {
            $flashcard->module()->associate(Module::inRandomOrder()->first());
            $flashcard->topic()->associate(Topic::inRandomOrder()->first());
            $flashcard->save();
        });
    }
}
