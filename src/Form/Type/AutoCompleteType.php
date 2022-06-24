<?php

namespace App\Form\Type;

use App\Form\DataTransformer\AutocompleteMultiTransformer;
use App\Form\DataTransformer\AutocompleteSimpleTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Allows to define a field with auto-complete process.
 * Required parameters :
 * - auto_complete_class : class of entity we want to have an auto-complete.
 * - auto_complete_property : property of previous entity to display (name or callable).
 * - auto_complete_route : name of route to call in order to get auto-complete values.
 * - auto_complete_route_parameter : name of query parameter to send to previous route when calling request.
 */
class AutoCompleteType extends AbstractType
{
    protected EntityManagerInterface $entityManager;

    protected UrlGeneratorInterface $generator;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $generator)
    {
        $this->entityManager = $entityManager;
        $this->generator = $generator;
    }

    /**
     * @throws Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $transformer = $options['multiple']
            ? new AutocompleteMultiTransformer($this->entityManager, $options['auto_complete_class'], $options['auto_complete_property'], $options['primary_key'])
            : new AutocompleteSimpleTransformer($this->entityManager, $options['auto_complete_class'], $options['auto_complete_property'], $options['primary_key'])
        ;

        $builder->addViewTransformer($transformer, true);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired([
            'auto_complete_class',
            'auto_complete_property',
            'auto_complete_route_parameter',
            'auto_complete_route',
        ]);

        $resolver->setAllowedTypes('auto_complete_class', 'string');
        $resolver->setAllowedTypes('auto_complete_property', ['string', 'callable']);
        $resolver->setAllowedTypes('auto_complete_route', 'string');
        $resolver->setAllowedTypes('auto_complete_route_parameter', ['null', 'string']);

        $resolver->setDefaults([
            'primary_key' => 'id',
            'multiple' => false,
            'compound' => false,
            'placeholder' => '',
            'required' => false,
            'disabled' => false,
        ]);
    }

    public function finishView(FormView $view, FormInterface $form, array $options): void
    {
        parent::finishView($view, $form, $options);

        $view->vars['dataset'] = [];
        $view->vars['dataset']['auto-complete'] = null;
        $view->vars['dataset']['auto-complete-url'] = $this->generator->generate($options['auto_complete_route']);
        $view->vars['dataset']['auto-complete-parameter'] = $options['auto_complete_route_parameter'];

        $varNames = ['multiple', 'placeholder', 'primary_key', 'disabled'];
        foreach ($varNames as $varName) {
            $view->vars[$varName] = $options[$varName];
        }

        if ($options['multiple']) {
            $view->vars['full_name'] .= '[]';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'auto_complete';
    }
}
