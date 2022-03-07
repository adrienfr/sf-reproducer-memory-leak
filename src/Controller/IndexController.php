<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Form\EditFlatType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/edit_flat/{id}", name="edit_flat")
     * @ParamConverter("flat", class="App:Flat")
     */
    public function editFlat(EntityManagerInterface $em, Request $request, Flat $flat): Response
    {
        $form = $this->createForm(EditFlatType::class, $flat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('edit_flat', ['id' => $flat->getId()]);
        }

        return $this->render('index/edit_flat.html.twig', [
            'flat' => $flat,
            'form' => $form->createView(),
        ]);
    }
}
