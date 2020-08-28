<?php

namespace App\Helpers;

use App\Models\Products\Color;
use App\Models\Products\Material;
use App\Models\Products\Size;

class Option
{
    public static function size(int $sizeId): ?string
    {
        return Size::getNameById($sizeId);
    }

    public static function material(int $materialId): ?string
    {
        return Material::findOrFail($materialId)->name;
    }

    public static function color(int $colorId): ?string
    {
        return Color::findOrFail($colorId)->name;
    }
}