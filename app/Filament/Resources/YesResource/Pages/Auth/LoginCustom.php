<?php

namespace App\Filament\Resources\YesResource\Pages\Auth;

use App\Filament\Resources\YesResource;
use Filament\Resources\Pages\Page;

class LoginCustom extends Page
{
    protected static string $resource = YesResource::class;

    protected static string $view = 'filament.resources.yes-resource.pages.auth.login-custom';
}
