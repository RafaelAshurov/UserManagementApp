<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == 'demo'){
            return [
                'id' => $this->id,
                'type' => $this->type,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'demo_exp_dif' => Carbon::parse($this->demo_exp)->diffForHumans(),
                'demo_exp' => $this->demo_exp,
            ];
        }else{
            return [
                'id' => $this->id,
                'type' => $this->type,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'credit_card' => $this->credit_card,
            ];
        }
    }
}
