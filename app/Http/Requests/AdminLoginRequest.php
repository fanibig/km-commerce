<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AdminLoginRequest extends FormRequest
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
            'login_or_email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'login_or_email.required' => 'This login field is required',
            'password.required' => 'This password field is required',
        ];
    }

    public function authenticate($login, $password)
    {
        $this->ensureIsNotRateLimited();

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : (preg_match('/^[0-9]+$/', $login) ? 'phone_number' : 'username');
        // logger()->info('Trying to authenticate with field: ' . $fieldType . ' and login: ' . $login);

        if (! Auth::guard('admin')->attempt([$fieldType => $login, 'password' => $password], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            // logger()->error('Authentication failed for ' . $login);

            throw ValidationException::withMessages([
                'login_or_email' => 'This ' . $fieldType . ' field is incorrect',
                'password' => 'This password is incorrect',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login_or_email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->string('login_or_email')) . '|' . $this->ip());
    }
}