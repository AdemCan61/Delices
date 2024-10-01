<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AjoutBonbonType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\TypeBonbon;
use Doctrine\ORM\EntityManagerInterface;


    class BaseController extends AbstractController
    {
        #[Route('/', name: 'app_accueil')] // /base est l’URL de la page, name est le nom de la route
            public function index(): Response
            {
                return $this->render('base/index.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            ]);
        }
        #[Route('/ajoute-bonbon', name: 'app_ajoutBonbon')] // /base est l’URL de la page, name est le nom de la route
            public function ajoutBonbon(Request $request, EntityManagerInterface $em): Response
            {
                $bonbon = new TypeBonbon();
                $form = $this->createForm(AjoutBonbonType::class, $bonbon);
                if($request->isMethod('POST')){
                    $form->handleRequest($request);
                    if ($form->isSubmitted()&&$form->isValid()){
                        $em->persist($bonbon);
                        $em->flush();
                        $this->addFlash('notice','Bonbon envoyé');
                        return $this->redirectToRoute('app_ajoutBonbon');
                    }
                }
                return $this->render('base/ajoute-bonbon.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
                'form' => $form->createView()
            ]);
        }

    }
