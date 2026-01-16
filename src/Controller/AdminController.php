<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Membre;
use App\Entity\Entrainement;
use App\Entity\Paiement;
use App\Form\AdminAddMemberType;
use App\Form\MemberType;
use App\Form\PaymentType;
use App\Form\TrainingType;
use App\Repository\EntrainementRepository;
use App\Repository\MembreRepository;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/members', name: 'app_admin_members')]
    public function members(MembreRepository $membreRepository, \App\Repository\UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        // Auto-fix: Ensure all users have a corresponding member profile
        $users = $userRepository->findAll();
        $changes = false;
        
        foreach ($users as $user) {
            if (!$membreRepository->findOneBy(['user' => $user])) {
                $membre = new Membre();
                $membre->setUser($user);
                $membre->setStatut('actif');
                $entityManager->persist($membre);
                $changes = true;
            }
        }
        
        if ($changes) {
            $entityManager->flush();
        }

        $members = $membreRepository->findAll();

        return $this->render('admin/members.html.twig', [
            'members' => $members,
        ]);
    }

    #[Route('/members/add', name: 'app_admin_member_add')]
    public function addMember(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $membre = new Membre();
        $form = $this->createForm(AdminAddMemberType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setEmail($form->get('email')->getData());
            $user->setName($form->get('name')->getData());
            $user->setRoles([$form->get('roles')->getData()]);
            $user->setPassword($passwordHasher->hashPassword($user, $form->get('password')->getData()));

            $entityManager->persist($user);

            $membre->setUser($user);
            $entityManager->persist($membre);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau membre ajouté avec succès.');

            return $this->redirectToRoute('app_admin_members');
        }

        return $this->render('admin/add_member.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/members/edit/{id}', name: 'app_admin_member_edit')]
    public function editMember(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MemberType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Membre mis à jour avec succès.');

            return $this->redirectToRoute('app_admin_members');
        }

        return $this->render('admin/edit_member.html.twig', [
            'member' => $membre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/members/delete/{id}', name: 'app_admin_member_delete', methods: ['POST'])]
    public function deleteMember(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $membre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($membre);
            $entityManager->flush();
            $this->addFlash('success', 'Membre supprimé avec succès.');
        }

        return $this->redirectToRoute('app_admin_members');
    }

    #[Route('/payments', name: 'app_admin_payments')]
    public function payments(PaiementRepository $paiementRepository): Response
    {
        $payments = $paiementRepository->findAll();

        return $this->render('admin/payments.html.twig', [
            'payments' => $payments,
        ]);
    }

    #[Route('/payments/add', name: 'app_admin_payment_add')]
    public function addPayment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payment = new Paiement();
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($payment);
            $entityManager->flush();

            $this->addFlash('success', 'Paiement enregistré avec succès.');

            return $this->redirectToRoute('app_admin_payments');
        }

        return $this->render('admin/add_payment.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/payments/edit/{id}', name: 'app_admin_payment_edit')]
    public function editPayment(Request $request, Paiement $payment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Paiement mis à jour avec succès.');

            return $this->redirectToRoute('app_admin_payments');
        }

        return $this->render('admin/edit_payment.html.twig', [
            'payment' => $payment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/payments/delete/{id}', name: 'app_admin_payment_delete', methods: ['POST'])]
    public function deletePayment(Request $request, Paiement $payment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $payment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($payment);
            $entityManager->flush();
            $this->addFlash('success', 'Paiement supprimé avec succès.');
        }

        return $this->redirectToRoute('app_admin_payments');
    }

    #[Route('/payments/receipt/{id}', name: 'app_admin_payment_receipt')]
    public function receiptPayment(Paiement $payment): Response
    {
        return $this->render('admin/receipt.html.twig', [
            'payment' => $payment,
        ]);
    }

    #[Route('/trainings', name: 'app_admin_trainings')]
    public function trainings(EntrainementRepository $entrainementRepository): Response
    {
        $trainings = $entrainementRepository->findAll();

        return $this->render('admin/trainings.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    #[Route('/trainings/add', name: 'app_admin_training_add')]
    public function addTraining(Request $request, EntityManagerInterface $entityManager): Response
    {
        $training = new Entrainement();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($training);
            $entityManager->flush();

            $this->addFlash('success', 'Entraînement créé avec succès.');

            return $this->redirectToRoute('app_admin_trainings');
        }

        return $this->render('admin/add_training.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trainings/edit/{id}', name: 'app_admin_training_edit')]
    public function editTraining(Request $request, Entrainement $training, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Entraînement mis à jour avec succès.');

            return $this->redirectToRoute('app_admin_trainings');
        }

        return $this->render('admin/edit_training.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trainings/delete/{id}', name: 'app_admin_training_delete', methods: ['POST'])]
    public function deleteTraining(Request $request, Entrainement $training, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $training->getId(), $request->request->get('_token'))) {
            $entityManager->remove($training);
            $entityManager->flush();
            $this->addFlash('success', 'Entraînement annulé avec succès.');
        }

        return $this->redirectToRoute('app_admin_trainings');
    }
}
