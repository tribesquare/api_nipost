<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
      'identifier' => [
        'required',
        'string',
      ],
      'password' => [
        'required',
        // 'min:8',
        // Password::min(8)
        //   ->mixedCase()
        //   ->numbers()
        //   ->symbols()
        //   ->uncompromised(),
        // 'confirmed'
      ]
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'identifier.required' => 'Identifier is required to be either email or staff code',
      'password.required' => 'Password is required',
      'password.min' => 'Password must be at least 8 characters',
    ];
  }
}
