<?php

namespace App\Http\Requests;

use App\Rules\UserNameLength;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    protected $errorBag = 'user';

    //protected $redirect = '';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(request()->user()->is(auth()->user())){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => [
                'required',
                new UserNameLength
                ],
            'email' => 'required'
        ];
    }
}
