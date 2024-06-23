<?php

namespace Database\Seeders;

use App\Models\Item;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = "ItemsSeederList.csv";
        $inputFile = storage_path('app/' . $file);
        $fp = fopen($inputFile, "r");
        while(!feof($fp)){

            $line=trim(fgets($fp, 1024));

            if($line != ""){

                $newItem = new Item;
                $newItem->name = $line;
                $newItem->save();

            }

        }

        fclose($fp);
    }
}
