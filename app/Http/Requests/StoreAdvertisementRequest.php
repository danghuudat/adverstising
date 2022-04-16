<?php

namespace App\Http\Requests;

use App\Helper\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreAdvertisementRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'description' => ['required','string','max:2000'],
            'price' => ['required','numeric'],
            'name' => ['required','string','max:200'],
            'images' => ['required','array'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if(isset($this->images)) {
                if(is_array($this->images)) {
                    $linkList = array_count_values($this->images);
                    foreach ($linkList as $key => $value) {
                        if($value >= 3) {
                            $validator->errors()->add('images', __('The link is dupplicate 3 times'));
                        }
                    }
                }
            }
        });
    }

}
