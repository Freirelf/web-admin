<?php

namespace App\Form;

use App\Entity\Enum\LanguageEnum;
use App\Entity\Product;
use App\Entity\ProductCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductType extends AbstractType
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
            ->add('title')
            ->add('code')
            ->add('shortDescription')
            ->add('youtubeVideo')
            ->add('language', ChoiceType::class, [
                'choices' => LanguageEnum::getLanguages(),
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false,
                'asset_helper' => false,
                'download_label' => false,

            ])
            ->add('description')
            ->add('category', EntityType::class, [
                'class' => ProductCategory::class,
                'choice_label' => function (ProductCategory $productCategory) {
                    return $productCategory->getTitle().' - '.LanguageEnum::getLanguageName($productCategory->getLanguage());
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
