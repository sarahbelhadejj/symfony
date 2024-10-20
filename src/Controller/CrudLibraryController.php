<?php

namespace App\Controller;

use App\Entity\Library; // Ensure you import the Library entity
use App\Repository\LibraryRepository; // Ensure you import the LibraryRepository
use Doctrine\ORM\EntityManagerInterface; // Import EntityManagerInterface
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/library')]
class CrudLibraryController extends AbstractController // Note the capitalization change
{
    #[Route('/list', name: 'app_crud_library')]
    public function list(LibraryRepository $repository): Response
    {
        $list = $repository->findAll(); 
        return $this->render('crud_library/list.html.twig', ['list' => $list]);
    }

    #[Route('/search/{name}', name: 'app_crud_library_search')]
    public function searchByName(LibraryRepository $repository, string $name): Response
    {
        $libraries = $repository->findBy(['name' => $name]);
        return $this->render('crud_library/list.html.twig', ['list' => $libraries]);
    }

    #[Route('/new', name: 'app_new_library')]
    public function newLibrary(EntityManagerInterface $entityManager): Response
    {
        $library = new Library();
        $library->setName('Central Library'); // Example name
        $library->setWebsite('http://central-library.com'); // Example website
        $library->setDatecreation('2023-01-01'); // Example creation date

        $entityManager->persist($library);
        $entityManager->flush();

        return $this->redirectToRoute('app_crud_library'); // Fixed redirectToRoute method and the route name
    }

    #[Route('/delete/{id}', name: 'app_delete_library')]
    public function deleteLibrary(Library $library, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($library);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_crud_library'); // Fixed route name
    }
}
