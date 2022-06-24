<?php

namespace App\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use LogicException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class AutocompleteSimpleTransformer implements DataTransformerInterface
{
    protected EntityManagerInterface $entityManager;

    protected string $className;

    protected mixed $textProperty;

    protected string $primaryKey;

    protected string $newTagPrefix;

    protected string $newTagText;

    protected PropertyAccessor $accessor;

    public function __construct(EntityManagerInterface $entityManager, string $class, mixed $textProperty = null, string $primaryKey = 'id')
    {
        $this->entityManager = $entityManager;
        $this->className = $class;
        $this->textProperty = $textProperty;
        $this->primaryKey = $primaryKey;
        $this->newTagPrefix = '__';
        $this->newTagText = ' (NEW)';
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @return array<string>
     */
    public function transform($entity): array
    {
        $data = [];
        if (empty($entity)) {
            return $data;
        }

        if (is_callable($this->textProperty)) {
            $text = call_user_func($this->textProperty, $entity);
        } else {
            $text = is_null($this->textProperty)
                ? (string) $entity
                : $this->accessor->getValue($entity, $this->textProperty)
            ;
        }

        if (false === $this->entityManager->contains($entity)) {
            throw new LogicException('Not found entity');
        }

        $value = (string) $this->accessor->getValue($entity, $this->primaryKey);

        $data[$value] = $text;

        return $data;
    }

    public function reverseTransform($value): mixed
    {
        if (empty($value) || true === is_iterable($value)) {
            return null;
        }

        try {
            $entity = $this->entityManager->createQueryBuilder()
                ->select('entity')
                ->from($this->className, 'entity')
                ->where('entity.'.$this->primaryKey.' = :id')
                ->setParameter('id', $value)
                ->getQuery()
                ->getSingleResult()
            ;
        } catch (Exception $e) {
            throw new TransformationFailedException(sprintf('The choice "%s" does not exist or is not unique', $value));
        }

        return $entity;
    }
}
