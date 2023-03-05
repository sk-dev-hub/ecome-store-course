<?php

namespace App\Http\Requests;

use Worksome\RequestFactories\Concerns\HasFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpFormRequest extends FormRequest
{
    use HasFactory;


    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
                'name' => ['required', 'string', 'min:1'],
                'email' => ['required',  'unique:users'],  //'email:dns',
                'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value()
        ]);
    }
}
