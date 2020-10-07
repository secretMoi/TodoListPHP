<?php

namespace Controllers\Pages\Login;

use Controllers\Pages\BaseController;

class SignIn extends BaseController
{
    public function Log()
    {
        $this->RenderSimple("Login\log");
    }
}
