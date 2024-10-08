<?php

namespace App\Command;

use App\Entity\ContactFormUrlPost;
use App\Entity\Enum\LanguageEnum;
use App\Entity\GeneralData;
use App\Entity\GlobalTags;
use App\Entity\PageSeo;
use App\Entity\User;
use App\Entity\WhoWeArePage;
use App\Repository\ContactFormUrlPostRepository;
use App\Repository\GeneralDataRepository;
use App\Repository\GlobalTagsRepository;
use App\Repository\PageSeoRepository;
use App\Repository\UserRepository;
use App\Repository\WhoWeArePageRepository;
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
    name: 'app:create-sample-data',
    description: 'Create initial sample data for the application.',
)]
class CreateSampleDataCommand extends Command
{
    public function __construct(
        private GeneralDataRepository $generalDataRepository, 
        private PageSeoRepository $pageSeoRepository, 
        private EntityManagerInterface $entityManager,
        private GlobalTagsRepository $globalTagsRepository,
        private ContactFormUrlPostRepository $contactFormUrlPostRepository,
        private WhoWeArePageRepository $whoWeArePageRepository,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
        )
    {
        parent::__construct();
    }

    protected function configure(): void {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        foreach (LanguageEnum::getLanguages() as $index => $option) {
            $pageSeo = $this->pageSeoRepository->findOneBy(['language' => $option]);
            if ($pageSeo) {
                $io->writeln('Page Seo em ' . $index . ' <comment> já exite</comment>');
            } else {
                $io->writeln('Page Seo em ' . $index . ' <info>criada</info>');

                $pageSeo = new PageSeo();
                $pageSeo->setHomePageTitle('Titulo da página');
                $pageSeo->setHomePageDescription('Descrição da página da página');
                $pageSeo->setAboutUsPageTitle('Titulo da página');
                $pageSeo->setAboutUsPageDescription('Descrição da página da página');
                $pageSeo->setProductListingPageTitle('Titulo da página');
                $pageSeo->setProductListingPageDescription('Descrição da página da página');
                $pageSeo->setNewsListingPageTitle('Titulo da página');
                $pageSeo->setNewsListingPageDescription('Descrição da página da página');
                $pageSeo->setServiceListingPageTitle('Titulo da página');
                $pageSeo->setServiceListingPageDescription('Descrição da página da página');
                $pageSeo->setFinancingListPageTitle('Titulo da página');
                $pageSeo->setFinancingListPageDescription('Descrição da página da página');
                $pageSeo->setVideoListingPageTitle('Titulo da página');
                $pageSeo->setVideoListingPageDescription('Descrição da página da página');
                $pageSeo->setLanguage($option);

                $this->entityManager->persist($pageSeo);
                $this->entityManager->flush();
            }
        }

        $generalData = $this->generalDataRepository->find(id: 1);
        if ($generalData) {
            $io->writeln('General Data <comment> já exite</comment>');
        } else {
            $io->writeln('General Data <info>criada</info>');
            $generalData = new GeneralData();
            $generalData->setEmail('email@dominio.com.br');
            $generalData->setAddress('Rua X, 123');
            $generalData->setPhone('(85) 3333-2222');

            $this->entityManager->persist($generalData);
            $this->entityManager->flush();
        }

        $globalTags = $this->globalTagsRepository->findAll();
        if ($globalTags) {
            $io->writeln('Global tags <comment> já exite</comment>');
        } else {
            $io->writeln('Global tags <info>criada</info>');
            $globalTags = new GlobalTags();
            $globalTags->setGa4('GA4');
            $globalTags->setPixelMetaAds('Meta pixel');
            $globalTags->setTagsGoogleAds('Google Ads');

            $this->entityManager->persist($globalTags);
            $this->entityManager->flush();
        }

        $contactFormUrl = $this->contactFormUrlPostRepository->findAll();
        if ($contactFormUrl) {
            $io->writeln('Url de postagem <comment> já exite</comment>');
        } else {
            $io->writeln('Global tags <info>criada</info>');
            $contactFormUrl = new ContactFormUrlPost();
            $contactFormUrl->setUrl('https://www.google.com.br');

            $this->entityManager->persist($contactFormUrl);
            $this->entityManager->flush();
        }

        foreach (LanguageEnum::getLanguages() as $index => $option) {
            $whoWeAre = $this->whoWeArePageRepository->findOneBy(['language' => $option]);
            if ($whoWeAre) {
                $io->writeln('Who we are ' . $index . ' <comment> já exite</comment>');
            } else {
                $io->writeln('Who we are ' . $index . ' <info>criada</info>');

                $whoWeAre = new WhoWeArePage();
                $whoWeAre->setPresentation('Parte 1 da descrição da página da página');
                $whoWeAre->setPresentationPart2('Parte 2 da descrição da página da página');
                $whoWeAre->setPresentationPart3('Parte 3 da descrição da página da página');

                $whoWeAre->setLanguage($option);

                $this->entityManager->persist($whoWeAre);
                $this->entityManager->flush();
            }
        }

        $user = $this->userRepository->findAll();
        if ($user) {
            $io->writeln('Admin' . ' <comment> já exite</comment>');
        } else {
            $io->writeln('Admin' . ' <info>criada</info>');

            $user = new User();
            $user->setEmail('admin@dominio.com.br');
            $user->setRoles(['ROLE_ADMIN']);
            $plaintextPassword = "root123";

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        $io->success('Data injected successfully.');

        return Command::SUCCESS;
    }
}
