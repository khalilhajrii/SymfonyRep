<?php

namespace YE\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use YE\StoreBundle\Entity\Categorie;
use YE\StoreBundle\Form\CategorieType;

class CategorieController extends Controller
{
    //Modification d'une catecorie
    public function ajoutAction(Request $request)
    {
        $categorie = new Categorie();
        $catform = $this->createForm(CategorieType::class, $categorie);
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $catform->handleRequest($request);
            if ($catform->isValid()) {
                $em->persist($categorie);
                $em->flush();
                return $this->redirectToRoute('categorie');
            }
        }
        return $this->render('@Store/Categorie/addedit.html.twig', array('cat' => $catform->createView()));
    }

    public function afficheAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository('StoreBundle:Categorie')->findAll();
        return $this->render('@Store/Categorie/Affiche.html.twig', array('catg' => $categories));
    }

    //Modification d'une catecorie
    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('StoreBundle:Categorie')->find($id);
        $catform = $this->createForm(CategorieType::class, $categorie);

        if ($request->isMethod('POST')) {
            $catform->handleRequest($request);
            if ($catform->isValid()) {
                $em->flush();
                $this->addFlash('success', 'categorie Modifiée avec succès!');
                return $this->redirectToRoute('categorie');
            }
        }


        return $this->render(
            '@Store/Categorie/addedit.html.twig',
            array(
                'cat' => $catform->createView()
            )
        );
    }

    //suppression d'une categorie
    public function SupprimerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('StoreBundle:Categorie')->find($id);
        $em->remove($categorie);
        $em->flush();
        $this->addFlash('success', 'categorie supprimé avec succès!');

        return $this->redirecttoRoute('categorie');
    }
}
