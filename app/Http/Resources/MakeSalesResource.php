<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MakeSalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => parent::toArray($request),
        "pagination"=> [
            "total"=> 50,
            "per_page"=> 15,
            "current_page"=> 1,
            "last_page"=> 4,
            "next_page_url"=> "...",
            "prev_page_url"=>"...",
            "from"=> 1,
            "to"=> 15,
        ],
                'links'=> [
                  
                ],
            ];
    }
}
