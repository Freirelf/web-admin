<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:admin-user',
    description: 'Add an user admin',
)]
class AdminUserCommand extends Command
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $entityManager, 
        private UserRepository $userRepository
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Email of the user')
            ->addArgument('arg2', InputArgument::OPTIONAL, 'Password of the user')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        $userEmail = 'admin2@gmail.com';
        $password = 'root123';

        $arg1= $input->getArgument('arg1');
        $arg2= $input->getArgument('arg2');

        if($arg1){
            $userEmail = $arg1;
        }

        if($arg2){
            $password = $arg2;
        }

        $user = new User();
        $user->setEmail($userEmail);
        $user->setRoles(['ROLE_ADMIN']);
        $passwordHash = $this->userPasswordHasher->hashPassword($user, $password);
        $user->setPassword($passwordHash);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->writeln('user created successfully!');
        $io->writeln('Email: '. $userEmail);
        $io->writeln('Password: '. $password);
        $io->writeln('Password Hash: '. $passwordHash);
        $io->writeln('Role: [\'ROLE_ADMIN\']');

        $io->success('Your admin user has been created!');

        return Command::SUCCESS;
    }
}
