<?php

namespace App\Controller;
use App\Entity\Book;    
use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
#[Route('/crud/book',)]
class CrudBookController extends AbstractController
{
    #[Route('/list', name: 'app_list_book')]
    public function newBook(ManagerRegistry $doctrine,Request $request): Response
    { //create instance of book
        $book=new Book();

         //create interface 
        $form=$this->createForm(BookType::class,$book );
       
       
        //get data from form //inteface 
          $form=$form->handleRequest ($request);

        //check if the form is valid and submitted 
        if($from->isSubmitted()&& $form ->isValid()){

      
        //getManager
        //save into the DB :flush 
        $em=$doctrine->getManger();
        $em->persist($book);
        $em->flush();
        return $this-SrecirectToRoute('app_book_list');

      //send interface th the user 
        
        
      return $this->render('crud_book/form.html.twig',['form'=>$form->createView()]);
    }
    #[Route('/list', name: 'app_book_list')]
    public function listbooks(BookRepository $repository): Response
    {$books=$repository->findall
    return $this->render('crud_bookd/list.html.twig',['books'=>$books])}
}
