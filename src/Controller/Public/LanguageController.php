<?php

namespace App\Controller\Public;

use App\Entity\Enum\LanguageEnum;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Attribute\Route;

class LanguageController extends BaseController
{
    #[Route('/public/language/{language}', name: 'app_public_language')]
    public function index($language): Response
    {   
        foreach (LanguageEnum::getLanguagesAbbreviated() as $index => $abbreviated) {
            if ($index == $language) {
                $this->session->set('language', $language);
            }
        }

        return $this->redirectToRoute('app_public_home');
    }
}
