<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeBonbonRepository;

class ListeBonbonController extends AbstractController
{
    #[Route('/liste-bonbon', name: 'app_liste_bonbon')]
    public function ListeBonbon(TypeBonbonRepository $listebonbonRepository): Response
    {
        $listebonbons = $listebonbonRepository->findAll();
        return $this->render('liste_bonbon/liste-bonbon.html.twig', [
            'listebonbons' => $listebonbons
        ]);
    }
}
