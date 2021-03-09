<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

/**
 * @Route("/", name="exam_")
 */

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @return Response
     */
    public function index(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();

        return $this->render('default/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     * @param EntityManagerInterface $entityManager
     * @param Contact|null $contact
     * @return Response
     */
    public function contact(EntityManagerInterface $entityManager, contact $contact = null): Response
    {
        if (empty($contact)) {
            $contact = new Contact();
            $contact->setEmail('test@test.com');
            $contact->setSubject('Ceci est un test');
            $contact->setMessage('Un message de test, pouvant être long, ou non. Celui-ci ne l\'est pas :) .');

            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->render('default/contact.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
