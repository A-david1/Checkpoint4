<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\ReadingStatus;
use App\Form\ReadingListType;
use App\Repository\ReadingStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @Route("/reading/{id_readingStatus}/edit/{id_book}", name="edit_reading")
     * @ParamConverter("book", class="App\Entity\Book", options={"mapping": {"id_book" : "id"}})
     * @ParamConverter("readingStatus", class="App\Entity\ReadingStatus", options={"mapping": {"id_readingStatus" : "id"}})
     * @IsGranted("ROLE_USER")
     */
    public function editReading(
        ReadingStatus $readingStatus,
        Book $book,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(ReadingListType::class, $readingStatus);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            return $this->redirectToRoute('reading');
        }
        return  $this->render('reading/edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
            'readingStatus' => $readingStatus
        ]);
    }


    /**
     * @Route("/reading/delete/{id}", name="delete_reading", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function deleteReadingStatus(
        Request $request,
        ReadingStatus $readingStatus,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $readingStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($readingStatus);
            $entityManager->flush();
        }
        return $this->redirectToRoute('reading');
    }
}
