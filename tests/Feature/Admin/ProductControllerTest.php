<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Indicates whether the Admin logged in.
     *
     */
    private function LoginAsfunction()
    {
        // Get Admin deatils from database
        $admin = User::find(1);
        //Logged in as Admin using admin guard
        Auth::guard('admin')->login($admin);

        return $this->actingAs($admin);
    }

    public function test_admin_can_access_product_management(): void
    {
        //Find Admin from database
        $admin = User::find(1);
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create product for check products list, create,edit,delete,status functionlity
        $product = Product::factory()->create();
        // Ensure admin can access product management routes
        //login as admin and checking route products list working or not
        $response = $this->actingAs($admin)->get(route('admin.products.index'));
        $response->assertStatus(200);
        //login as admin and checking route product create form working or not
        $response = $this->actingAs($admin)->get(route('admin.products.create'));
        $response->assertStatus(200);
        //login as admin and checking route product edit form working or not
        $response = $this->actingAs($admin)->get(route('admin.products.edit', $product->id));
        $response->assertStatus(200);
        //login as admin and checking route product delete working or not
        $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_see_list_product(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create product for check products list view show or not
        $product = Product::factory()->create();
        //checking route for product list working or not
        $response = $this->get(route('admin.products.index'));
        $response->assertStatus(200);
    }
    public function test_admin_can_create_product(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create product for check product create form view show or not
        $product = Product::factory()->create();
        //checking route for product create form working or not
        $response = $this->get(route('admin.products.create'));
        $response->assertStatus(200);
    }
    public function test_admin_can_store_product(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create product for check product store functionlity
        $response = $this->post(route('admin.products.store'), [
            '_token' => csrf_token(),
            'title' => 'First Product',
            'name' => 'Shoes',
            'quantity' => 12,
            'price' => 100,
        ]);
        //after create product check redirect functionality
        $response->assertRedirect(route('admin.products.index'));
        $response->assertStatus(302);
    }

    public function test_admin_can_edit_product(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create product for checking edit form form view show or not
        $product = Product::factory()->create();
        $response = $this->get(route('admin.products.edit', $product->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_update_product(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create product for checking update product functionality
        $product = Product::factory()->create();
        //update product code
        $this->patch(route('admin.products.update', $product->id), [
            '_token' => csrf_token(),
            'title' => 'Updated First Product',
            'name' => 'Shoes Updated',
            'quantity' => 50,
            'price' => 200,
        ]);
        //request role validation error
        $product->refresh();
        //check updated record equal or not
        $this->assertEquals('Updated First Product', $product->title);
    }

    public function test_admin_can_change_product_status(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create product for updating status of product
        $product = Product::factory()->create();
        $response = $this->get(url('/admin/products/status/' . $product->id . '/' . ($product->is_active == 1 ? 0 : 1)));
        $response->assertStatus(200);
    }

    public function test_regular_user_cannot_access_product_management()
    {
        //create product for checking product except admin can access product management or not
        $user = User::factory()->create();
        //create product for edit or destroy route
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.products.edit', $product->id));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->delete(route('admin.products.destroy', $product->id));
        $response->assertStatus(302);
    }
}
