<?php

namespace App\Controller;

use App\Entity\Imagen;
use App\Form\CategoryFormType;
use App\Form\ImagenFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SubmitType;
class ImagenController extends AbstractController
{
    #[Route('/admin/images', name: 'app_images')]
public function images(ManagerRegistry $doctrine, Request $request): Response
{
    $image = new Imagen();
    $form = $this->createForm(ImagenFormType::class, $image);
    
    $form->handleRequest($request);
   
    if ($form->isSubmitted() && $form->isValid()) {
        $image = $form->getData();    
        $entityManager = $doctrine->getManager();    
        $entityManager->persist($image);
        $entityManager->flush();
    }
    return $this->render('admin/images.html.twig', array(
        'form' => $form->createView()
    ));
}

}
