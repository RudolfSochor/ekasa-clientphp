<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Poloha prenosnej registračnej pokladne vo voľnom textovom formáte.
 */
final class OtherLocationDto extends LocationDto
{
    /**
     * Voľný textový reťazec s polohou
     */
    public string $value;

    /**
     * Typ polohy
     */
    public $type = "Other";
}
