<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceFormType;
use App\Repository\InvoiceRepository;
use App\Repository\InvoiceLinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoices', name: 'invoice_list')]
    public function list(InvoiceRepository $invoiceRep): Response{

        return $this->render('invoice/list.html.twig', [
            'invoices' => $invoiceRep->findAll()
        ]);
    }

    #[Route('/invoice/{invoice_id}', name: 'invoice_detail')]
    public function invoice($invoice_id, InvoiceLinesRepository $invoiceLineRep, InvoiceRepository $invoiceRep): Response{
        return $this->render('invoice/invoice.html.twig', [
            'invoiceLines' => $invoiceLineRep->findBy(['invoice' => $invoice_id]),
            'invoice' => $invoiceRep->findOneBy(['id' => $invoice_id])
        ]);
    }

    #[Route('/invoice_add', name: 'app_invoice')]
    public function accueil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceFormType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('invoice_list');
        }

        return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
            'invoiceForm' => $form->createView(),
        ]);
    }
}
