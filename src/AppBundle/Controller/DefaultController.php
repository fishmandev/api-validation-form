<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Post;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\View\View;

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

    /**
     * @Post("/user")
     * @param Request $request
     * @ApiDoc(
     *     section = "User",
     *     description = "Simple user entity",
     *     input = {
     *         "class" = "AppBundle\Form\Type\UserType",
     *         "name" = ""
     *     },
     *     parameters = {
     *         {"name" = "detail_id", "dataType" = "integer", "required" = true, "description" = "The user detail ID"},
     *     },
     *     statusCodes = {
     *         201 = "Returned when successful",
     *         400 = "Returned when the parameters are not valid"
     *     },
     *     responseMap = {
     *         201 = {
     *             "class" = User::class,
     *             "parsers" = {JmsMetadataParser::class}
     *         },
     *         400 = {
     *             "class" = UserType::class,
     *             "form_errors" = true,
     *             "name" = ""
     *         }
     *     }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userAction(Request $request)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            throw new BadRequestHttpException('Fill in all the required fields, please');
        }

        if (!$form->isValid()) {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        $user = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->view($user, Response::HTTP_CREATED);
    }
}
