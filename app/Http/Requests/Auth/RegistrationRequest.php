<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required|string',
      'role_id' => 'required|string',
      'email' => 'required|email|unique:users,email',
      'staff_code' => 'required|string|unique:users,staff_code',
      'password' => [
        'required',
        Password::min(8)
          ->mixedCase()
          ->numbers()
          ->symbols()
          ->uncompromised(),
      ]
    ];
  }

  // public function messages(): array
  // {
  //   return [
  //     'email.unique' => 'This email is already assigned to a user',
  //   ];
  // }
}
