<?php

namespace App\Helpers;

class Filter
{
    public static function iconDirection(string $sortField, string $fieldName, bool $directionAsc)
    {
        return $sortField === $fieldName ? ($directionAsc ? '&darr;' : '&uarr;') : '&bullet;';
    }
}
