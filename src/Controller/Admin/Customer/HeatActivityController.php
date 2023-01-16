<?php

namespace App\Controller\Admin\Customer;

use App\Entity\Customer;
use App\Entity\HeatActivity;
use App\Form\Customer\HeatActivityType;
use App\Repository\ActivityHeatRepository;
use App\Service\CustomerManager;
use App\Service\QrCodeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/facility', name: 'app_admin_facility')]
class HeatActivityController extends AbstractController
{
    #[Route('/new/{id}', name: '_new')]
    public function new(
        Customer               $customer,
        Request                $request,
        CustomerManager        $customerManager,
        QrCodeManager          $qrCodeManager,
        ActivityHeatRepository $activityHeatRepository,
    ): Response
    {
        $heatActivity = new HeatActivity();
        $heatActivity->setCustomer($customer);

        $form = $this->createForm(HeatActivityType::class, $heatActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heatActivity->setEntryLink($customerManager->generateHeatEntryLink($customer->getId(), $customer->getUser()));
            $qrCodeUrl = $qrCodeManager->createQrCode($heatActivity);
            $heatActivity->setQrCodeUrl($qrCodeUrl);
            $activityHeatRepository->save($heatActivity, true);

            return $this->redirectToRoute('app_admin_customer_list');
        }

        return $this->render('customer/heat_activity_new.html.twig', [
            'form' => $form,
            'customer' => $customer,
        ]);
    }
}