<?php

namespace App\Controller\HeatActivity;

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
    public function index(HeatActivity $heatActivity): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CUSTOMER');

        return $this->render('heat_activity_entry/index.html.twig', [
            'heatActivity' => $heatActivity,
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

            // TODO: TMP, redirect to log
            return $this->redirectToRoute('app_heat_activity_entry_index', ['id' => $heatActivity->getId()]);
        }

        return $this->render('heat_activity_entry/new.html.twig', [
            'form' => $form,
        ]);
    }


}