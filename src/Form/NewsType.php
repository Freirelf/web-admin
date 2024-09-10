<?php

namespace App\Form;

use App\Entity\Enum\LanguageEnum;
use App\Entity\News;
use App\Entity\NewsCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Ativo' => 1,
                    'Inativo' => 0,
                ]
            ])
            ->add('highlighted', ChoiceType::class, [
                'choices' => [
                    'Ativo' => 1,
                    'Inativo' => 0,
                ]
            ])
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('title')
            ->add('shortDescription')
            ->add('youtubeVideoCode')
            ->add('fullDescription')
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false,
                'asset_helper' => false,
                'download_label' => false,

            ])
            ->add('language', ChoiceType::class, [
                'choices' => LanguageEnum::getLanguages(),
            ])
            ->add('category', EntityType::class, [
                'class' => NewsCategory::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
