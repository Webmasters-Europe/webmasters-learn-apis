<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('seed')->get('swapi/films.json');

        $data = json_decode($json);

        foreach ($data as $item) {
            $link = new Film();
            $link->id = $item->id;
            $link->fields = json_encode($item->fields);
            $link->save();
        }
    }
}