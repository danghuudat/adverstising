<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Models\Advertisement;

class StoreAdvertisementRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'description' => ['required', 'string', 'max:' . Advertisement::MAX_CHARACTERS_DESCRIPTION],
            'price' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:' . Advertisement::MAX_CHARACTERS_NAME],
            'photos' => ['required', 'array'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this->photos)) {
                if (is_array($this->photos)) {
                    $linkList = array_count_values($this->photos);
                    foreach ($linkList as $key => $value) {
                        if ($value >= 3) {
                            $validator->errors()->add('photos', 'The link is duplicate 3 times');
                        }
                    }
                }
            }
        });
    }

}
