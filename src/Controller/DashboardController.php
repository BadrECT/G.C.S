<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{


    #[Route('/dashboard', name: 'app_member_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function memberDashboard(\App\Repository\EntrainementRepository $entrainementRepository, \App\Repository\MembreRepository $membreRepository, \App\Repository\PaiementRepository $paiementRepository): Response
    {
        $user = $this->getUser();
        $details = [];
        $paiements = [];
        $entrainements = [];

        if ($user) {
            // Fetch next upcoming trainings
            $entrainements = $entrainementRepository->findBy([], ['dateHeure' => 'ASC'], 5);

            // Fetch member details if user is linked to a Member profile
            $membre = $membreRepository->findOneBy(['user' => $user]);
            if ($membre) {
                $paiements = $paiementRepository->findBy(['membre' => $user], ['datePaiement' => 'DESC']);
            }
        }

        return $this->render('dashboard/member.html.twig', [
            'entrainements' => $entrainements,
            'paiements' => $paiements,
        ]);
    }
}
