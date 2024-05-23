<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * TODO
 */
final class LocationRegistrationRequestDto
{
    /**
     * @see GeoCoordinates
     */
    public string $id;

    /**
     * @see PhysicalAddressDto
     */
    public string $externalId;

    /**
     * TODO
     */
    public LocationRegistrationRequestHeaderDto $header;

    /**
     * TODO
     */
    public LocationRegistrationRequestLocationDto $locationData;
}
