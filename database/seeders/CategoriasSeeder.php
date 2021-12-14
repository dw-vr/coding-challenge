<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use File;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Load the json file with example data
        $json = File::get("data/catalog.json");
        $products = json_decode($json,true);

        //iterate trought every product, 
        //inserting the category if not exists
        
        foreach ($products['products'] as $key => $value ){
            //check if category already exists
            $category = Category::where('name', '=', $value['category'])->first();
            if(isnull($category)){
                Category::create([
                    "name"=>$value['category']]);
            }
        }
    }
}
