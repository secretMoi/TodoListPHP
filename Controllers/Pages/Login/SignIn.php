<?php

namespace Controllers\Pages\Login;

use Controllers\Pages\BaseController;

class SignIn extends BaseController
{
    public function Log()
    {
        $this->Render("Login\log");
    }
}
