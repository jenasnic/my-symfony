<?php

namespace App\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum MyEnum: string implements TranslatableInterface
{
    case ALPHA = 'Alpha';
    case BRAVO = 'Bravo';
    case CHARLIE = 'Charlie';

    public function trans(TranslatorInterface $translator, string $locale = null): string
    {
        return sprintf('myenum.trans : %s // %s', $this->name, $this->value);
    }
}
