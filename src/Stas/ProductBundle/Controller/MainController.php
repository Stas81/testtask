<?php

namespace Stas\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Doctrine\ORM\Tools\Pagination\Paginator;

class MainController extends Controller
{
    public function indexAction($name = null)
    {
        return $this->render('StasProductBundle:Main:index.html.twig', array('name' => $name));
    }
    
    
    public function listAction()
    {
        $em = $this->getDoctrine()->getRepository('StasProductBundle:Category');
        $categories = $em->findAll();        
        return $this->render('StasProductBundle:Main:list.html.twig',array('categories' => $categories));
    }


    
    public function listProductsAction($category_id, $page)
    {
        define('PRODUCTS_PER_PAGE',7);
        $firstResult = ($page-1)*PRODUCTS_PER_PAGE;
        
        $repo = $this->getDoctrine()->getRepository('StasProductBundle:Category');
        $category = $repo->Find($category_id);
        
        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT p from StasProductBundle:Product p WHERE p.category = :category ORDER BY p.name';
        
        $query = $em -> createQuery($dql)
                        ->setFirstResult($firstResult)
                        ->setMaxResults(PRODUCTS_PER_PAGE)
                        ->setParameter('category',$category_id);
        
        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $pagesCount = ceil(count($paginator) / PRODUCTS_PER_PAGE);

        return $this->render('StasProductBundle:Main:products.html.twig',
                    array('products' => $paginator,
                          'pagescount' => $pagesCount,
                          'page' => $page,                        
                          'category' => $category -> getName(),
                          'category_id' => $category -> getId(),
                ));
    }

}
