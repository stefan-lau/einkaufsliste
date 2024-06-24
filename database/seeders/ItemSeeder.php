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
        $inputFile = storage_path( $file );
        $fp = fopen($inputFile, "r");
        while(!feof($fp)){

            $line=explode(";", trim(fgets($fp, 1024)));

            if($line[0] != ""){

                $newItem = new Item;
                $newItem->name = $line[0];
                $newItem->active = $line[1];
                $newItem->save();

            }

        }

        fclose($fp);
    }
}
