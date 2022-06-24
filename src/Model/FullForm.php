<?php

namespace App\Model;

use App\Entity\File;
use DateTime;
use Nodevo\ReferenceBundle\Entity\ReferenceValue;

class FullForm
{
    public bool $checkbox = false;

    public ?DateTime $date = null;

    public ?string $email = null;

    public ?File $file = null;

    public ?string $radio = null;

    public ?ReferenceValue $selectSimple = null;

    public array $selectMultiple = [];

    public ?string $phone = null;

    public ?string $textarea = null;

    public ?string $autocompleteSimple = null;

    public ?string $autocompleteMultiple = null;
}
