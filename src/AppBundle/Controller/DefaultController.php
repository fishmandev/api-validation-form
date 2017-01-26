<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/")
     * @ApiDoc(
     *     section = "Default",
     *     description = "Default index action",
     * )
     */
    public function indexAction()
    {
        $data = ['message' => 'Hello API!'];
        $view = $this->view($data);

        return $this->handleView($view);
    }
}
