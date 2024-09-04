<?php

namespace App\Form;

use App\Entity\Enum\LanguageEnum;
use App\Entity\PageSeo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageSeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('homePageTitle')
            ->add('homePageDescription')
            ->add('aboutUsPageTitle')
            ->add('aboutUsPageDescription')
            ->add('productListingPageTitle')
            ->add('productListingPageDescription')
            ->add('newsListingPageTitle')
            ->add('newsListingPageDescription')
            ->add('serviceListingPageTitle')
            ->add('serviceListingPageDescription')
            ->add('financingListPageTitle')
            ->add('financingListPageDescription')
            ->add('videoListingPageTitle')
            ->add('videoListingPageDescription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PageSeo::class,
        ]);
    }
}
