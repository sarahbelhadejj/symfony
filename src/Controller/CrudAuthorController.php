<?php

namespace App\Controller;

use App\Entity\Author; // Ensure you import the Author entity
use App\Repository\AuthorRepository; // Ensure you import the AuthorRepository
use Doctrine\ORM\EntityManagerInterface; // Import EntityManagerInterface
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/author')]
class CrudAuthorController extends AbstractController
{
    #[Route('/list', name: 'app_crud_author')]
    public function list(AuthorRepository $repository): Response
    {
        $list = $repository->findAll(); 
      
        return $this->render('crud_author/list.html.twig', ['list' => $list]);
    }

    #[Route('/search/{name}', name: 'app_crud_author_search')]
    public function searchByName(AuthorRepository $repository, string $name): Response
    {
        $authors = $repository->findBy(['name' => $name]); // Adjust to match your repository method

        return $this->render('crud_author/list.html.twig', ['list' => $authors]);
    }

    #[Route('/new', name: 'app_new_author')]
    public function newAuthor(EntityManagerInterface $entityManager): Response
    {
        $author = new Author();
        $author->setName('Ahmed'); // Removed 'name:' for simplicity
        $author->setEmail('ahmed@gmail.com'); // Removed 'email:' for simplicity
        $author->setAdresse('Tunis'); // Corrected 'setAdress' to 'setAddress'
        $author->setNbrBooks(4); // Corrected 'setNbrbooks' to 'setNbrBooks'

        $entityManager->persist($author);
        $entityManager->flush();

        return $this->redirectToRoute('app_crud_author'); // Fixed redirectToRoute method and the route name
    }
    #[Route('/delete/{id}', name: 'app_delete_author')]
      public function deleteAuthor(Author $author , ManagerRegistry $doctrine): Response
    {
       $em=$doctrine->getManager();
       $em->remove($author);
       $em->flush();
       return $this->redirectToRoute(route:"app_list_author");
    }
}
