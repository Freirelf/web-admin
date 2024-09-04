<?php

namespace App\Form;

use App\Entity\Enum\LanguageEnum;
use App\Entity\WhoWeArePage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WhoWeArePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('presentation')
            ->add('presentationPart2')
            ->add('presentationPart3')
            ->add('youtubeVideoCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WhoWeArePage::class,
        ]);
    }
}
