<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'fname'=> $this->fname ,
            'lname'=> $this-> lname ,
            'password'=> $this->password,
            'username'=> $this->username ,
            'gender'=> $this-> gender,
            'national_id'=> $this->national_id ,
            'phone_number'=> $this->phone_number ,
            'email'=> $this->email ,
            'city'=> $this-> city,
            'street'=> $this->street ,
            'overview'=> $this->overview ,
            'university'=> $this->university,
            'specialization'=> $this->specialization ,
            'experience'=> $this->experience ,
            'type'=> $this->type ,
            'skills'=> $this-> skills,
            'category_id'=> $this->category_id,
        ];




    }
}
