<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * TODO
 */
final class LocationDto
{
    /**
     * @see GeoCoordinates
     */
    public ?string $gps;

    /**
     * @see PhysicalAddressDto
     */
    public ?string $address;

    /**
     * TODO
     */
    public ?string $other;
}
