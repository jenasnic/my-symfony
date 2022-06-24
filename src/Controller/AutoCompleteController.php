<?php

namespace App\Controller;

use App\Enum\ReferenceValueListEnum;
use Nodevo\ReferenceBundle\Repository\ReferenceValueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutoCompleteController extends AbstractController
{
    public function __construct(protected ReferenceValueRepository $referenceValueRepository)
    {
    }

    #[Route('/autocomplete-cities', name: 'autocomplete_cities', methods: ['GET'])]
    public function autocomplete(Request $request): Response
    {
        $value = trim($request->query->get('value'));

        $values = (strlen($value) > 0)
            ? $this->findReferenceValues($value)
            : []
        ;

        return new JsonResponse($values);
    }

    private function findReferenceValues(string $value): array
    {
        $queryBuilder = $this->referenceValueRepository
            ->createReferenceQueryBuilder(ReferenceValueListEnum::CITY->name)
            ->select('reference_value.id', 'reference_value.value')
            ->andWhere('reference_value.value LIKE :value')
            ->setParameter('value', "%$value%")
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
