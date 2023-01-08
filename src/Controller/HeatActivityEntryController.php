<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Facility;
use App\Entity\HeatActivity;
use App\Entity\HeatActivityEntry;
use App\Form\ActivityEntry\HeatActivityEntryType;
use App\Repository\HeatActivityEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/heat-activity-entry', name: 'app_heat_activity_entry')]
class HeatActivityEntryController extends AbstractController
{
    #[Route('/{id}', name: '_index', methods: ['GET'])]
    public function index(Facility $facility): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CUSTOMER');

        return $this->render('heat_activity_entry/index.html.twig', [
            'facility' => $facility,
        ]);
    }

    #[Route('/new/{id}', name: '_new')]
    public function new(HeatActivity $heatActivity, Request $request, HeatActivityEntryRepository $activityEntryRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_CUSTOMER');

        $heatActivityEntry = new HeatActivityEntry();
        $heatActivityEntry->setHeatActivity($heatActivity);

        $form = $this->createForm(HeatActivityEntryType::class, $heatActivityEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $activityEntryRepository->save($heatActivityEntry, true);

            return $this->redirectToRoute('app_admin_customer_list');
        }

        return $this->render('heat_activity_entry/new.html.twig', [
            'form' => $form,
        ]);
    }
}