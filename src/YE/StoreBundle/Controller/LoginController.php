<?php

namespace YE\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('@Store/Owner/login.html.twig');
    }
}