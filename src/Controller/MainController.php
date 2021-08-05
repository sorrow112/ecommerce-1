<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Entity\categorie;
use App\Entity\PanierAchat;
use App\Entity\Produit;
use App\Entity\SousCategorie;
use Doctrine\ORM\EntityManager;

class MainController extends AbstractController
{

    use TargetPathTrait;


    function getCategory(){
        $repository = $this->getDoctrine()->getRepository(categorie::class);
        $categories = $repository->findAll();
        return $categories;
    }
    function getSousCat(){
        $repository = $this->getDoctrine()->getRepository(SousCategorie::class);
        $souscat = $repository->findAll();
        return $souscat;
    }
    function getAllProds(){
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repository->findAll();
        return $produit;
    }
    /** 
    * @Route("/contactus", name="contact")
    */
    public function contactus(SessionInterface $session ,ProduitRepository $produitRepository): Response{
        $souscat = $this->getSousCat();
        $categories = $this->getCategory();
        $panierWithData = $this->getPanier($session, $produitRepository);
        if ($this->getUser() == null) {
            return $this->render('main/contactus.html.twig', ['user' => '', 'categories' => $categories, 'souscats' => $souscat,'items'=> []]);

        } else {
            return $this->render('main/contactus.html.twig', [
                'user' => $this->getUser(),
                'categories' => $categories,
                'souscats' => $souscat,
                'items' => $panierWithData
                
            ]);
        }
    }
    /**
     * @Route("/submitpanel", name="submitpanel")
     */

    public function submitpanel(SessionInterface $session ,ProduitRepository $produitRepository){
        $panierWithData = $this->getPanier($session, $produitRepository);
        $panier = $session->get('panier',[]);
        $produits=[];
        foreach ($panier as $id => $quantity){
            $produits[]=[
                'product' => $produitRepository->find($id)->getId(),
                'quantity' => $quantity,
            ];

        }
        $souscat = $this->getSousCat();
        $categories = $this->getCategory();
        $panier = new PanierAchat();
        $panier->setDateDeCreation(new \DateTime());
        $panier->setProduits($produits);
        $panier->setUser($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($panier);
        $entityManager->flush();
        return $this->render('main/index.html.twig', [
            'user' => $this->getUser(),
            'items' => $panierWithData,
            'categories' => $categories,
            'souscats' => $souscat,
                
        ]);
        
    }

    /**
     * @Route("/", name="root")
     */
    public function index(SessionInterface $session ,ProduitRepository $produitRepository): Response
    {
        $souscat = $this->getSousCat();
        $categories = $this->getCategory();
        $panierWithData = $this->getPanier($session, $produitRepository);
        if ($this->getUser() == null) {
            return $this->render('main/index.html.twig', ['user' => '', 'categories' => $categories, 'souscats' => $souscat,'items'=> []]);

        } else {
            return $this->render('main/index.html.twig', [
                'user' => $this->getUser(),
                'categories' => $categories,
                'souscats' => $souscat,
                'items' => $panierWithData
                
            ]);
        }
    }

        function getPanier(SessionInterface $session, ProduitRepository $produitRepository){
            
            
            $products = $this->getAllProds();
            $panier = $session->get('panier',[]);
            $panierWithData = [];
            foreach ($panier as $id => $quantity){
                $panierWithData[]=[
                    'product' => $produitRepository->find($id),
                    'quantity' => $quantity,
                ];

            }
            return $panierWithData;
        }

        /**
        * @Route("/show/{souscatID}", name="showall")
        */
        public function showall(int $souscatID, SessionInterface $session, ProduitRepository $produitRepository): Response
        {

            $repository = $this->getDoctrine()->getRepository(Produit::class);
            
            $categories = $this->getCategory();
            $souscat = $this->getSousCat();
            $products = $produitRepository->findProducts($souscatID);

            //            affichage de panier
            $panierWithData = $this->getPanier($session, $produitRepository);
//            ...
            
            if ($this->getUser() == null) {
                return $this->render('main/show.html.twig', ['user' => '', 'categories' => $categories, 'souscats' => $souscat, 'products' => $products,
                'items'=> []]);

            } else {
                return $this->render('main/show.html.twig', [
                    'user' => $this->getUser(),
                    'categories' => $categories,
                    'souscats' => $souscat,
                    'products' => $products,
                    'items' => $panierWithData,
                    'cat' => $souscatID
                ]);
            }
        }


        /**
        * @route("/panier/add/{catID}/{id}", name="cart_add")
        */
        public function add_cart($id, $catID, SessionInterface $session){
            $panier = $session->get('panier', []);
            if(!empty($panier[$id])){
                $panier[$id]++;

            }
            else{
                $panier[$id] = 1;
            }

            $session->set('panier', $panier);
            return $this->redirect('http://127.0.0.1:8000/show/'.(integer)$catID);
           
}
}