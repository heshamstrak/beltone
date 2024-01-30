<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name'              => 'required',
            'email'             => 'required|email',
            'job'               => 'required',
            'image'             => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'phone'             => 'sometimes|nullable',
            'facebook_link'     => 'sometimes|nullable',
            'twitter_link'      => 'sometimes|nullable',
            'linkedin_link'     => 'sometimes|nullable',
        ];


        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = 'sometimes|nullable';
        }//end of if
 
        return $rules;

    }//end of rules


}//end of request
