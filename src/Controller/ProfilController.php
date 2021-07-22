<?php

namespace App\Controller;


use App\Repository\ReadingListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProfilController extends AbstractController
{
    public const OVER = 'Terminé';

    /**
     * @Route("/profil", name="profil")
     * @IsGranted("ROLE_USER")
     */
    public function profil( $readingListRepository): Response
    {
        $user = $this->getUser();
        $lastBooksRead = $readingListRepository->findBy(['status' => self::OVER]);
        return $this->render('profil/profil.html.twig', [
            'lastBooks' => $lastBooksRead,
        ]);
    }
}
