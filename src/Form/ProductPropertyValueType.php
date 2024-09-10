<?php

namespace App\Form;

use App\Entity\Enum\LanguageEnum;
use App\Entity\Product;;
use App\Entity\ProductProperty;
use App\Entity\ProductPropertyValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPropertyValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value')
            ->add('productProperty', EntityType::class, [
                'class' => ProductProperty::class,
                'choice_label' => function (ProductProperty $productProperty) {
                    return $productProperty->getTitle().' - '.LanguageEnum::getLanguageName($productProperty->getLanguage());
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductPropertyValue::class,
        ]);
    }
}
