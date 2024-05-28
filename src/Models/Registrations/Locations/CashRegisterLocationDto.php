<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Poloha prenosnej registračnej pokladne
 */
final class CashRegisterLocationDto
{
    /**
     * Poloha registračnej pokladne
     * Poloha pokladne typu @see cref="GeoCoordinatesDTO",
     * @see cref="PhysicalAddressDTO" alebo @see cref="OtherLocationDTO"
     */
    public LocationDto $location;
}
