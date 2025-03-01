<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Efficiently seeds 1,000,000 products using batch inserts.
     *
     * @return void
     */
    public function run(): void
    {
        $totalProducts = 1_000_000; // Total number of products to insert
        $batchSize = 5000; // Number of records per batch insert
        $products = [];
        $counts = 0;
        $startTime = microtime(true);

        // Products Inserting (Batching)
        for ($i = 1; $i <= $totalProducts; $i++) {
            $products[] = [
                'image' => "https://picsum.photos/600/400?random={$i}",
                'name' => "Product " . $i,
                'price' => rand(100, 5000),
            ];


            if ($i % $batchSize == 0) // Batch insert every 5000 records 
            {
                DB::table('products')->insert($products); //Insert the products
                $products = []; // Clear the products
                $counts += 1; // Count the number of execution
            }
        }
        
        // Insert remaining records if any
        if (!empty($products)) {
            DB::table('products')->insert($products);
        }

        $endTime = microtime(true);
        dump('Batch Seeding Complete at :' . ($endTime - $startTime), 'How many insert execution: ' . $counts, 'Counts the number of products in database: ' . Product::count());
    }
}