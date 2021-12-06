<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use File;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            //Drop all products in products datatable
            Product::truncate();
            //Load the json file with example data
            $json = File::get("data/catalog.json");
            $products = json_decode($json,true);
            
            //Populate table with new example data
            foreach ($products['products'] as $key => $value ){
                //obtain the category ID
                $category = Category::where('name', '=', $value['category'])->first();
                if(!($category ===null)){
                    $this->command->line($category);
                    Product::create([
                        "name"=>$value['name'],
                        "category_id"=>$category['id'],
                        "sku"=>$value['sku'],
                        "price"=>$value['price'],
                        "quantity"=>$value['quantity']
                        ]);
                }
                else{
                    //This should NOT happen ever in example data
                    $this->command->line('Cannot insert product because category does not exist yet. Skipping');
                }
            }
        }
    }
}
