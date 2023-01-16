<?php

namespace App\Controller\Admin\Customer;

use App\Entity\Customer;
use App\Form\Customer\CustomerType;
use App\Repository\ActivityHeatRepository;
use App\Repository\CustomerRepository;
use App\Repository\FacilityRepository;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/customer', name: 'app_admin_customer')]
class CustomerController extends AbstractController
{
    #[Route('/new', name: '_new')]
    public function new(Request $request, CustomerRepository $customerRepository, UserManager $userManager)
    {
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->createUser($customer);

            $customerRepository->save($customer, true);

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('customer/customer_new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/list', name: '_list')]
    public function list(CustomerRepository $customerRepository): Response
    {
        return $this->render('customer/customer_list.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: '_edit')]
    public function edit(Request $request, Customer $customer, CustomerRepository $customerRepository, ActivityHeatRepository $activityHeatRepository): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $customerRepository->save($customer, true);

            return $this->redirectToRoute('app_admin_customer_list');
        }

        return $this->render('customer/customer_edit.html.twig', [
            'form' => $form,
            'customer' => $customer,
            'heatActivities' => $activityHeatRepository->findBy(['customer' => $customer]),
        ]);
    }
}