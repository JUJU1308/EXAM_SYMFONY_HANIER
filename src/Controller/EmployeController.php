<?php

namespace App\Controller;
use App\Entity\Employe;
use App\Form\EmployeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class EmployeController extends AbstractController
{
    /**
     * @Route("/liste", name="liste_employe")
     */
    public function index()
    {
  
        $employes = $this->getDoctrine()->getRepository(Employe::class)->findAll();


        return $this->render('employe/index.html.twig',
            [
                'employes'=> $employes
            ]
        );
    }

// Ajout d'un employé
    /**
     * @Route("/add", name="add_employe")
     */
  function addEmploye(Request $request)
    {
        $form = $this->createForm(EmployeType::class, new Employe());

       $form->handleRequest($request);

       if($form->isSubmitted() and $form->isValid()){
           $employe = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($employe);
           $entityManager->flush();
           return $this->redirectToRoute('liste_employe');
       } else {

           return $this->render('employe/add.html.twig',
               [
                   'form'=> $form->createView()
               ]);
       }
    }

    /**
     * @Route("/update/{employe}", name="update_employe")
     */
    function updatePlanet(Employe $employe, Request $request)
    {

        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $employe = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('liste_employe');
        } else {
            return $this->render('employe/edit.html.twig',
                [
                    'form'=> $form->createView()
                ]);
        }

        return $this->render('employe/edit.html.twig', [
            'employe'=> $employe,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{employe}", name="delete_employe")
     */
    function deleteEmploye(Employe $employe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($employe);
        $entityManager->flush();
        return $this->redirectToRoute('liste_employe');
    }

}