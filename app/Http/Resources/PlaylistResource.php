<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => [
                'formatted' => formatPrice($this->price),
                'unformatted' => $this->price,
            ],
            'description' => $this->description,
            'thumbnail' => $this->picture,
            'author' => $this->author,
            'videos' => $this->videos_count,
        ];
    }
}
