<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Models\Advertisement;

class GetAdvertisementRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'per_page' => ['numeric'],
            'page' => ['numeric'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $this->withValidatorOrderBy($validator);
        $this->withValidatorOrderType($validator);
    }

    public function withValidatorOrderBy(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->order_by)) {
                if($this->order_by != 'price' && $this->order_by != 'created_at') {
                    $validator->errors()->add('order_by', 'The order_by is invalid');
                }
            }
        });
    }

    public function withValidatorOrderType(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->order_type)) {
                if($this->order_type != 'asc' && $this->order_type != 'desc') {
                    $validator->errors()->add('order_type', 'The order_type is invalid');
                }
            }
        });
    }

}
