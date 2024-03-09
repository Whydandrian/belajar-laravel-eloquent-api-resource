<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
   public function testProductDataWrap()
   {
      $this->seed([CategorySeeder::class, ProductSeeder::class]);
      $products = Product::first();

      $this->get("/api/products/$products->id")
         ->assertStatus(200)
         ->assertJson([
            "value" => [
               "name" => $products->name,
               "category" => [
                  "id" => $products->category->id,
                  "name" => $products->category->name,
               ],
               "price" => $products->price,
               "created_at" => $products->created_at->toJson(),
               "updated_at" => $products->updated_at->toJson(),
            ]
         ]);
   }

   public function testCollectionDataWrap()
   {
      $this->seed([CategorySeeder::class, ProductSeeder::class]);

      $response = $this->get("/api/products")
         ->assertStatus(200);

      $names = $response->json("data.*.name");
      for ($i = 0; $i < 5; $i++) {
         self::assertContains("Product $i of Food", $names);
      }

      for ($i = 0; $i < 5; $i++) {
         self::assertContains("Product $i of Gadget", $names);
      }
   }

   public function testProductPaging()
   {
      $this->seed([CategorySeeder::class, ProductSeeder::class]);

      $response = $this->get("/api/products-paging")
         ->assertStatus(200);

      self::assertNotNull($response->json("links"));
      self::assertNotNull($response->json("meta"));
      self::assertNotNull($response->json("data"));
   }
}
