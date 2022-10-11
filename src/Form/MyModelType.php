<?php

namespace App\Form;

use App\Entity\MyModel;
use App\Enum\MyEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('code', ChoiceType::class, [
                'choices' => [
                    'Alpha' => MyEnum::ALPHA,
                    'Bravo' => MyEnum::BRAVO,
                    'Charlie' => MyEnum::CHARLIE,
                ],
            ])
            ->add('value')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MyModel::class,
        ]);
    }
}
