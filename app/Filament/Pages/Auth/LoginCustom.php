<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login;
use Illuminate\Validation\ValidationException;

class LoginCustom extends Login
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getLoginFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data')
            ),
        ];
    }

    protected function getLoginFormComponent(): \Filament\Forms\Components\TextInput
    {
        return TextInput::make('login')
            ->label(__('Name / Email'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): \Filament\Forms\Components\TextInput
    {
        return TextInput::make('password')
            ->label(__('Password'))
            ->password()
            ->required()
            ->autocomplete('current-password')
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getRememberFormComponent(): \Filament\Forms\Components\Checkbox
    {
        return \Filament\Forms\Components\Checkbox::make('remember')
            ->label(__('Remember me'))
            ->extraInputAttributes(['tabindex' => 3]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        // Determine if the login is an email or username
        $loginType = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $loginType => $data['login'], // Use either 'email' or 'name' based on the input
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
