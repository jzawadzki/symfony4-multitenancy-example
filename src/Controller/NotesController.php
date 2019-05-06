<?php

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->json([
            'endpoints' => [
                'GET /notes' => 'Lists all notes',
                'PUT /notes' => 'Add note'
            ]
        ]);
    }

    /**
     * @Route("/notes", name="note_add", methods={"PUT"})
     */
    public function addNote(Request $request, EntityManagerInterface $entityManager)
    {
        $message = $request->get('message', '');
        if (!$message) {
            throw new BadRequestHttpException("Message cannot be empty");
        }

        $note = new Note($message);
        $entityManager->persist($note);
        $entityManager->flush();

        return $this->json([
            'note' => [
                'id' => $note->getId(),
                'message' => $note->getMessage()
            ]
        ]);
    }


    /**
     * @Route("/notes", name="notes", methods={"GET"})
     */
    public function notes(NoteRepository $noteRepository)
    {
        $notes = $noteRepository->findAll();

        return $this->json([
            'notes' => array_map(function (Note $note) {
                return ['id' => $note->getId(),
                    'message' => $note->getMessage()
                ];
            }, $notes)
        ]);
    }
}
