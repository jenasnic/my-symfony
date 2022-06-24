<?php

namespace App\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class AutocompleteMultiTransformer implements DataTransformerInterface
{
    protected EntityManagerInterface $em;

    protected string $className;

    protected mixed $textProperty;

    protected string $primaryKey;

    protected string $newTagPrefix;

    protected string $newTagText;

    protected PropertyAccessor $accessor;

    public function __construct(EntityManagerInterface $em, string $class, mixed $textProperty = null, string $primaryKey = 'id')
    {
        $this->em = $em;
        $this->className = $class;
        $this->newTagPrefix = '__';
        $this->textProperty = $textProperty;
        $this->primaryKey = $primaryKey;
        $this->newTagText = ' (NEW)';
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @return array<string>
     */
    public function transform($entities): array
    {
        if (empty($entities)) {
            return [];
        }

        $data = [];
        foreach ($entities as $entity) {
            if (is_callable($this->textProperty)) {
                $text = call_user_func($this->textProperty, $entity);
            } else {
                $text = is_null($this->textProperty)
                    ? (string) $entity
                    : $this->accessor->getValue($entity, $this->textProperty)
                ;
            }

            if ($this->em->contains($entity)) {
                $value = (string) $this->accessor->getValue($entity, $this->primaryKey);
            } else {
                $value = $this->newTagPrefix.$text;
                $text = $text.$this->newTagText;
            }

            $data[$value] = $text;
        }

        return $data;
    }

    /**
     * @return array<object>
     */
    public function reverseTransform($values): array
    {
        if (!is_array($values) || empty($values)) {
            return [];
        }

        $newObjects = [];
        $tagPrefixLength = strlen($this->newTagPrefix);

        foreach ($values as $key => $value) {
            $cleanValue = substr($value, $tagPrefixLength);
            $valuePrefix = substr($value, 0, $tagPrefixLength);
            if ($valuePrefix == $this->newTagPrefix) {
                $object = new $this->className();
                $this->accessor->setValue($object, $this->textProperty, $cleanValue);
                $newObjects[] = $object;
                unset($values[$key]);
            }
        }

        try {
            $entities = $this->em->createQueryBuilder()
                ->select('entity')
                ->from($this->className, 'entity')
                ->where('entity.'.$this->primaryKey.' IN (:ids)')
                ->setParameter('ids', $values)
                ->getQuery()
                ->getResult()
            ;
        } catch (Exception $e) {
            throw new TransformationFailedException('One or more id values are invalid');
        }

        return array_merge($entities, $newObjects);
    }
}
