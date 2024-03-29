<?php

namespace App\Logic\Common;

class FormattedMathResolver
{
    public function hasFormattedMath($entity): bool
    {
        return (str_contains($entity->getDescription(), '$') || str_contains($entity->getName(), '$'));
    }
}
