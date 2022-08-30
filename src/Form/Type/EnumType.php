<?php

namespace App\Form\Type;

use LogicException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnumType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired(['class', 'label_prefix'])
            ->setAllowedTypes('class', 'string')
            ->setAllowedTypes('label_prefix', 'string')
            ->setDefaults([
                'choices' => function (Options $options): array {
                    if (!method_exists($options['class'], 'getAll')) {
                        throw new LogicException('Enumeration must implements method "getAll"');
                    }

                    return $options['class']::getAll();
                },
                'choice_label' => function (Options $options): \Closure {
                    return static function (string $value) use ($options): string {
                        return sprintf('%s.%s', $options['label_prefix'], $value);
                    };
                },
            ])
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
