<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * @Route("/product")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('Entity:Product');
        $products[] = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController', 'products' => $products
        ]);
    }

    /**
     * @Route("/product/new")
     */
    public function addOne(Request $request)
    {
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', TextType::class)
            ->add('save', SubmitType::class, ['label' =>'Create Product'])
            ->getForm();
            
        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
