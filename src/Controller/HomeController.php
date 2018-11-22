<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", options={"expose"=true})
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/home/save", name="home_save", options={"expose"=true})
     */
    public function save(Request $request)
    {
        $date = $request->query->get('date');
        var_dump($date);
        die();
        return $this->redirect($this->generateUrl('home'));
    }
}
