<?php

namespace App\Http\Requests;

use App\Rules\Initial;
use App\Rules\SpikklAddress;
use App\Rules\Zipcode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'initials' => ['required', 'string', 'max:255', new Initial()],
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'zipcode' => ['bail', 'required', 'string', 'size:6', new Zipcode()],
            'house_number' => ['bail', 'required', 'int', new SpikklAddress()],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'phone:NL,DE,mobile'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->uncompromised()],
        ];
    }
}
