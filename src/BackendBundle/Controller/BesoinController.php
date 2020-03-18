<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Besoin;
use BackendBundle\Entity\Entrepot;
use BackendBundle\Form\BesoinType;
use BackendBundle\Form\MonBesoinType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BesoinController extends Controller
{

    public function createOneAction(Request $request){
        $besoin=new Besoin();
        $form=$this->createForm(BesoinType::class,$besoin);
        $form->handleRequest($request);
        $entrepots=$this->getDoctrine()->getRepository(Entrepot::class)->findAll();
      /*  if ($form->isSubmitted()){
            $echeance=$request->request->get("echeance");

         //   $time = date('H:i:s \O\n d/m/Y');
            $besoin->setDate( new \DateTime('now'));
            $besoin->setStatut("Non traiter");
            $besoin->setEcheance($echeance);
            $reference="Ref0001";
            $besoin->setReference($reference);
            $em= $this->getDoctrine()->getManager();
            $em->persist($besoin);
            $em->flush();
            return $this->redirectToRoute("backend_besoin_createOne");
        }*/
        return $this->render('@Backend/Besoin/createOne.html.twig',array("entrepots"=>$entrepots));
    }
    public function addBesoinAction(Request $request){
        $echeance=$request->request->get("echeance");
        $id_entrepot=$request->request->get("entrepot");
        $entrepot=$this->getDoctrine()->getRepository(Entrepot::class)->find((int)$id_entrepot);
        $besoin=new Besoin();
        $besoin->setDate( new \DateTime('now'));
        $besoin->setStatut("Non traiter");
        $besoin->setEcheance($echeance);
        $besoin->setEntrepot($entrepot);
        $reference="Ref0001";
        $besoin->setReference($reference);
        $em= $this->getDoctrine()->getManager();
        $em->persist($besoin);
        $em->flush();
        return $this->redirectToRoute("backend_besoin_createOne");

    }
    public function createTwoAction($id){


    }
}
