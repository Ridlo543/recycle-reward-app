<?php

namespace App\Filament\User\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Models\User;
use Filament\Forms\Components\Component;
use Illuminate\Support\Facades\Hash;


class UserRegister extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getAddressFormComponent(),
                        $this->getContactFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getAddressFormComponent(): Component
    {
        return TextInput::make('address')
            ->label(__('Alamat'))
            ->required()
            ->maxLength(255);
    }

    protected function getContactFormComponent(): Component
    {
        return TextInput::make('contact')
            ->label(__('Nomor Telepon'))
            ->tel()
            ->telRegex('/^08[0-9]{9,}$/')
            ->required()
            ->maxLength(15);
    }
}
