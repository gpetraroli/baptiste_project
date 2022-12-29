<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'app_admin')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: '_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }
}