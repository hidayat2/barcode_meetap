<?php

namespace Database\Seeders;

use App\Models\Scan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas =
        [
            [ 'id' => 1, 'title' => 'Simposium' ],
            [ 'id' => 2, 'title' => 'Workshop 1' ],
            [ 'id' => 3, 'title' => 'Workshop 2' ],
            [ 'id' => 4, 'title' => 'Workshop 3' ],
            [ 'id' => 5, 'title' => 'Workshop 4' ],
            [ 'id' => 6, 'title' => 'Pameran' ],
            [ 'id' => 7, 'title' => 'Snack' ],
        ] ;

        foreach ($datas as $key => $data)
        {
            Scan::create($data);
        }
    }
}
