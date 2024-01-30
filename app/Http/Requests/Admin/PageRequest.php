<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'description' => 'sometimes|nullable',
            'parent_id'   => 'sometimes|nullable',     
            'slug'        => 'sometimes|nullable',     
        ];

 
        return $rules;

    }//end of rules


}//end of request
