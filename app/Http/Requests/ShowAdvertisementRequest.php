<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Models\Advertisement;

class ShowAdvertisementRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'fields' => ['array'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->fields)) {
                if(is_array($this->fields)) {
                    foreach($this->fields as $field) {
                        if($field != 'description' && $field != 'link') {
                            $validator->errors()->add('fields', 'The fields is invalid.');
                        }
                    }
                }
            }
        });
    }

}
