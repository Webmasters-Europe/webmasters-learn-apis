<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Solar extends JsonResource
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
            'bodies' => route('solar.bodies', $options),
        ];
    }
}
