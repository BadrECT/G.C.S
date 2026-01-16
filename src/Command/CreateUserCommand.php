<?php

namespace App\Command;

use App\Entity\User;
use App\Entity\Membre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-admin')]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Clean up first to avoid duplicates or corrupt data
        $this->entityManager->getConnection()->executeStatement('SET FOREIGN_KEY_CHECKS=0; DELETE FROM membres; DELETE FROM users; SET FOREIGN_KEY_CHECKS=1;');

        $user = new User();
        $user->setEmail(trim('admin@gcs.com'));
        $user->setName('Admin User');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        
        $this->entityManager->persist($user);
        
        $membre = new Membre();
        $membre->setUser($user);
        $membre->setStatut('actif');
        $membre->setCategorie('Staff');
        
        $this->entityManager->persist($membre);
        $this->entityManager->flush();

        $output->writeln('Admin user created with email: admin@gcs.com and password: admin');

        return Command::SUCCESS;
    }
}
