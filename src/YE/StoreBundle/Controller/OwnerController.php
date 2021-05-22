<?php

namespace YE\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YE\StoreBundle\Entity\owner;
use YE\StoreBundle\Form\ownerType;


class OwnerController extends Controller
{
    //ajouter u utilisateur
    public function ajoutAction(Request $request)
    {

        $Owner = new owner();
        $ownerform = $this->createForm(ownerType::class, $Owner);
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $ownerform->handleRequest($request);
            if ($ownerform->isValid()) {
                $em->persist($Owner);
                $em->flush();
                return $this->redirectToRoute('owner');
            }
        }


        return $this->render(
            '@Store/Owner/addedit.html.twig',
            array(
                'form' => $ownerform->createView()
            )
        );
    }

    //Afficher un utilisateur
    public function afficheAction()
    {

        $em = $this->getDoctrine()->getManager();
        $owners = $em->getRepository('StoreBundle:owner')->findAll();
        return $this->render('@Store/Owner/Affiche.html.twig', array('own' => $owners));
    }

    //modifier un utilisateur
    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Owner = $em->getRepository('StoreBundle:owner')->find($id);
        $ownerform = $this->createForm(ownerType::class, $Owner);

        if ($request->isMethod('POST')) {
            $ownerform->handleRequest($request);
            if ($ownerform->isValid()) {
                $em->flush();
                $this->addFlash('success', 'owner Modifiée avec succès!'); 
                return $this->redirectToRoute('owner');
            }
        }


        return $this->render(
            '@Store/Owner/addedit.html.twig',
            array(
                'form' => $ownerform->createView()
            )
        );
    }

    //suppression d'un utilisateur
    public function SupprimerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $owner = $em->getRepository('StoreBundle:owner')->find($id);
        $em->remove($owner);
        $em->flush();
        $this->addFlash('success', 'owner supprimé avec succès!');

        return $this->redirecttoRoute('owner');
    }
}
