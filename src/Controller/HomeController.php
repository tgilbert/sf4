<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RangerPicker;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", options={"expose"=true})
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $dates = $em->getRepository('App:RangerPicker')->findAll();
        $adate = array();
        foreach ($dates as $date) {
            $adate[] = $date->toArray();
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'dates' => \json_encode($adate)
        ]);
    }

    /**
     * @Route("/home/save", name="home_save", options={"expose"=true})
     */
    public function save(Request $request)
    {
        $dates = $request->query->get('date');
        $em = $this->getDoctrine()->getManager();
        $datesExist = $em->getRepository('App:RangerPicker')->findAll();
        foreach ($datesExist as $dateExist) {
            $em->remove($dateExist);
            $em->flush();
        }
        if ($dates) {
            foreach ($dates as $date) {
                $ranger = new RangerPicker();
                $ranger->setStartDate($date[0])
                ->setEndDate($date[1]);
                $em->persist($ranger);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('home'));
    }
}
