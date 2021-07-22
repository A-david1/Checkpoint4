<?php

namespace App\Controller;

use App\Repository\ReadingStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReadingController extends AbstractController
{

    public const IN_PROGRESS = 'En cours';
    public const TO_READ = 'A lire';

    /**
     * @Route("/reading", name="reading")
     * @IsGranted("ROLE_USER")
     */
    public function reading(ReadingStatusRepository $statusRepository): Response
    {
        // TODO Add button to edit
        $user = $this->getUser();

        $readingBooks = $statusRepository->findBy(
            ['readingList' => $user->getReadingList(),
            'status' => self::IN_PROGRESS
            ]);
        $futureBooks = $statusRepository->findBy(
            ['readingList' => $user->getReadingList(),
                'status' => self::TO_READ
            ]);

        return $this->render('reading/reading.html.twig', [
            'readingBooks' => $readingBooks,
            'futureBooks' => $futureBooks
        ]);
    }
}
