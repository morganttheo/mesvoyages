<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author theom
 */

    
class VoyagesController extends AbstractController {
    /**
     * @Route("/voyages",name="voyages")
     * @return Response
     */
    private $repository;
    
    public function __construct(VisiteRepository $repository){
       $this->repository = $repository;
    }
    
     /**
     * @Route("/voyages",name="voyages")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation','DESC');
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]); 
    }
    
    /**
     * @route("/voyages/tri/{champ}/{ordre}", name="voyages.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort($champ, $ordre): Response{
        $visites = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]); 
    }
    
    
}
