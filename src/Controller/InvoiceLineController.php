<?php

namespace App\Controller;

use App\Entity\InvoiceLines;
use App\Form\InvoiceLineFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InvoiceLinesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceLineController extends AbstractController
{
    #[Route('/invoice_line', name: 'add_invoice_line')]
    public function accueil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoiceLine = new InvoiceLines();
        $form = $this->createForm(InvoiceLineFormType::class, $invoiceLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            
            $entityManager->persist($invoiceLine);
            $entityManager->flush();

            return $this->redirectToRoute('invoiceline_list');
        }

        return $this->render('invoice_line/index.html.twig', [
            'controller_name' => 'InvoiceLineController',
            'invoiceLineForm' => $form->createView(),
        ]);
    }

    #[Route('/invoice_lines', name: 'invoiceline_list')]
    public function list(InvoiceLinesRepository $invoiceLineRep): Response{

        return $this->render('invoice_line/list.html.twig', [
            'invoiceLines' => $invoiceLineRep->findAll()
        ]);
    }
}
