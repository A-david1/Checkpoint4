<?php

namespace App\Controller;


use App\Entity\ReadingStatus;
use App\Repository\ReadingStatusRepository;
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
    public function profil(ReadingStatusRepository $statusRepository): Response
    {
        $user = $this->getUser();

        $finishedBooks = $statusRepository->findBy(
            ['readingList' => $user->getReadingList(), 'status' => self::OVER ],
            ['id' => 'DESC'],
            2
        );

        return $this->render('profil/profil.html.twig', [
                'finishedBooks' => $finishedBooks,
        ]);
    }
}
