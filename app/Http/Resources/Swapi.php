<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Swapi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $domain = $request->route('domain');
        $options = [
            'domain' => $domain,
        ];

        return [
            'films' => route('swapi.films', $options),
            'people' => route('swapi.people', $options),
            'planets' => route('swapi.planets', $options),
            'species' => route('swapi.species', $options),
            'starships' => route('swapi.starships', $options),
            'vehicles' => route('swapi.vehicles', $options),
        ];
    }
}
