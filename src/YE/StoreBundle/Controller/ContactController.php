<?php

namespace YE\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Store/Default/Contact.html.twig');
    }
}
