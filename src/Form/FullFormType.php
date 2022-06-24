<?php

namespace App\Form;

use App\Form\Type\AutoCompleteType;
use App\Form\Type\WysiwygType;
use App\Model\FullForm;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\RegionCode;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Nodevo\ReferenceBundle\Entity\ReferenceValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FullFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('checkbox', CheckboxType::class, ['required' => false])
//            ->add('date', DateType::class, [
//                'widget' => 'single_text',
//            ])
//            ->add('email', EmailType::class)
//            ->add('radio', ChoiceType::class, [
//                'expanded' => true,
//                'multiple' => false,
//                'choices' => [
//                    'radio_1' => 'radio_1',
//                    'radio_2' => 'radio_2',
//                    'radio_3' => 'radio_3',
//                ],
//            ])
//            ->add('selectSimple', ChoiceType::class, [
//                'choices' => [
//                    'simple_1' => 'simple_1',
//                    'simple_2' => 'simple_2',
//                    'simple_3' => 'simple_3',
//                ],
//            ])
//            ->add('selectMultiple', ChoiceType::class, [
//                'multiple' => true,
//                'choices' => [
//                    'multiple_1' => 'multiple_1',
//                    'multiple_2' => 'multiple_2',
//                    'multiple_3' => 'multiple_3',
//                ],
//            ])
//            ->add('phone', PhoneNumberType::class, [
//                'format' => PhoneNumberFormat::NATIONAL,
//                'default_region' => RegionCode::FR,
//            ])
//            ->add('textarea', WysiwygType::class)
//            ->add('autocompleteSimple', AutoCompleteType::class, [
//                'auto_complete_class' => ReferenceValue::class,
//                'auto_complete_property' => 'value',
//                'auto_complete_route_parameter' => 'value',
//                'auto_complete_route' => 'autocomplete_cities',
//
//            ])
//            ->add('file', FileType::class)
            ->add('button', ButtonType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FullForm::class,
        ]);
    }
}
