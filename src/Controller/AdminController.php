<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryFormType;



class AdminController extends AbstractController
{

    #[Route('/admin/categories', name: 'app_categories')]
public function categories(ManagerRegistry $doctrine, Request $request): Response
{
    $repositorio = $doctrine->getRepository(Category::class);

    $categories = $repositorio->findAll();

    $category = new Category();
    $form = $this->createForm(CategoryFormType::class, $category);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $category = $form->getData();    
        $entityManager = $doctrine->getManager();    
        $entityManager->persist($category);
        $entityManager->flush();
    }
    return $this->render('admin/categories.html.twig', array(
        'form' => $form->createView(),
        'categories' => $categories   
    ));

}



}
