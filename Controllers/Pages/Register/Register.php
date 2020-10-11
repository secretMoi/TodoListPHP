<?php

namespace Controllers\Pages\Register;

use Controllers\Pages\BaseController;

class Register extends BaseController
{
    public function Register()
    {
        $this->RenderSimple("Register\\register");
    }
}