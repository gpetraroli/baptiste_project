<?php

namespace App\Controller\Admin\Customer;

use App\Entity\Customer;
use App\Entity\Facility;
use App\Entity\HeatActivity;
use App\Form\Customer\FacilityType;
use App\Repository\FacilityRepository;
use App\Service\CustomerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/facility', name: 'app_admin_facility')]
class FacilityController extends AbstractController
{
    #[Route('/new/{id}', name: '_new')]
    public function new(Customer $customer, Request $request, FacilityRepository $facilityRepository, CustomerManager $customerManager): Response
    {
        $facility = new Facility();
        $facility->setCustomer($customer);

        $heatActivity = new HeatActivity();
        $heatActivity->setLabel('test');
        $facility->addHeatActivity($heatActivity);

        $form = $this->createForm(FacilityType::class, $facility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facility->setConsultLink($customerManager->generateHeatEntryLink($customer->getId(), $customer->getUser()));
            $facilityRepository->save($facility, true);

            return $this->redirectToRoute('app_admin_customer_list');
        }

        return $this->render('customer/facility_new.html.twig', [
            'form' => $form,
            'facility' => $facility,
        ]);
    }

}