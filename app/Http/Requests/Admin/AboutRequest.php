<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'icon'        => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['icon'] = 'sometimes|nullable';
        }//end of if
 
        return $rules;

    }//end of rules


}//end of request
