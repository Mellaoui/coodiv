<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Matiere;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // -- Create Roles -- //

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // -- Create Matiere Permissions -- //

        Permission::create(['name' => 'view matieres']);
        Permission::create(['name' => 'create matieres']);
        Permission::create(['name' => 'update matieres']);
        Permission::create(['name' => 'delete matieres']);
        Permission::create(['name' => 'restore matieres']);
        Permission::create(['name' => 'force delete matieres']);

        // -- Create Category Permissions -- //

        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'restore categories']);
        Permission::create(['name' => 'force delete categories']);

        // -- Create Product Permissions -- //

        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'restore products']);
        Permission::create(['name' => 'force delete products']);

        // -- Create Order Permissions -- //

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);
        Permission::create(['name' => 'restore orders']);
        Permission::create(['name' => 'force delete orders']);

        // -- Assign Permissions to Roles -- //

        $adminRole->givePermissionTo(Permission::all());

        $userRole->givePermissionTo([
            'view matieres',
            'view categories',
            'view products',
            'view orders',
        ]);

        // -- Create Users -- //

        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@shoop.com',
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@shoop.com',
        ]);

        // -- Assign Roles to Users -- //

        $admin->assignRole('admin');
        $user->assignRole('user');

        // -- Add Media to Users -- //

        User::each(function (User $user) {
            $user->addMediaFromUrl('https://source.unsplash.com/random/?smile')
                ->toMediaCollection('avatars');
        });

        // -- Create Matiere -- //

        Matiere::factory()
            ->count(5)
            ->state(new Sequence(
                ['name' => 'Gold'],
                ['name' => 'Silver'],
                ['name' => 'Platinum'],
                ['name' => 'Diamond'],
                ['name' => 'Pearl'],
            ))
            ->create();

        // -- Create Categories -- //

        Category::factory()
            ->count(10)
            ->state(new Sequence(
                ['name' => 'Rings'],
                ['name' => 'Necklaces'],
                ['name' => 'Earrings'],
                ['name' => 'Bracelets'],
                ['name' => 'Pendants'],
                ['name' => 'Bangles'],
                ['name' => 'Brooches'],
                ['name' => 'Chains'],
                ['name' => 'Cufflinks'],
                ['name' => 'Charms'],
            ))
            ->create();

        // -- Create Products -- //

        Product::factory()->count(100)->create();

        // -- Add Media to Products -- //

        Product::each(function (Product $product) {
            $product->addMediaFromUrl('https://source.unsplash.com/random/100x100')
                ->toMediaCollection('products');
        });

        // -- Create Orders -- //

        Order::factory()->count(20)->create();
    }
}
