<?php

namespace App\Filament\User\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getAddressFormComponent(),
                $this->getContactFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function getAddressFormComponent(): TextInput
    {
        return TextInput::make('address')
            ->label(__('Alamat'))
            ->required()
            ->maxLength(255);
    }

    protected function getContactFormComponent(): TextInput
    {
        return TextInput::make('contact')
            ->label(__('Nomor Telepon'))
            ->tel()
            ->telRegex('/^08[0-9]{9,}$/')
            ->required()
            ->maxLength(15);
    }
}
