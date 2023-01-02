<?php

namespace App\Controller\Admin\Customer;

use App\Entity\Customer;
use App\Form\Customer\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/customer', name: 'app_admin_customer')]
class CustomerController extends AbstractController
{
    #[Route('/new', name: '_new')]
    public function new(Request $request, CustomerRepository $customerRepository)
    {
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->save($customer, true);

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('customer/customer_new.html.twig', ['form' => $form]);
    }

}