<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Poloha prenosnej registračnej pokladne vo forme GPS súradníc.
 */
final class GeoCoordinatesDto extends LocationDto
{
    /**
     * Zemepisná dĺžka
     */
    public float $longitude;

    /**
     * Zemepisná šírka
     */
    public float $latitude;

    /**
     * Typ polohy
     */
    public $type = "GPS";
}
