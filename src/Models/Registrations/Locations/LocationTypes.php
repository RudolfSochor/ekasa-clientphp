<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Typy lokácií
 */
final class LocationTypesDto
{
    /**
     * GPS súradnica
     */
    public const GPS = "GPS";

    /**
     * Fyzická adresa
     */
    public const ADDRESS = "Address";

    /**
     * Voľný textový formát
     */
    public const OTHER = "Other";
}
