<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/show', name: 'app_author_show')]
    public function showAuthor(): Response
    {
        $authorName = 'Victor Hugo';
        $authorEmail = 'vg@gmail.com';

        return $this->render('author/showauthor.html.twig', [
            'authorName' => $authorName,
            'authorEmail' => $authorEmail,
        ]);
    }

    #[Route('/list', name: 'app_author_list')]
    public function listAuthors(): Response
    {
        $authors = [
            ["authorName" => "Victor Hugo", "picture" => "images/img1.jpg", "nbrBooks" => 44],
            ["authorName" => "jhon jaques roso", "picture" => "images/img2.jpg", "nbrBooks" => 74]
        ];

        return $this->render('author/listauthors.html.twig', [
            'authors' => $authors
        ]);
    }
}
