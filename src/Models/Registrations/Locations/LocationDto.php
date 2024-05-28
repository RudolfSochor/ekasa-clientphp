<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

// NOTE: Do not remove this line. Deserialization will fail.
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @DiscriminatorMap(typeProperty="$type", mapping={
 *    "GPS"="NineDigit\eKasa\Client\Models\Registrations\Locations\GeoCoordinatesDto",
 *    "Address"="NineDigit\eKasa\Client\Models\Registrations\Locations\PhysicalAddressDto",
 *    "Other"="NineDigit\eKasa\Client\Models\Registrations\Locations\OtherLocationDto"
 * })
 */
abstract class LocationDto
{
    /**
     * @SerializedName("$type")
     * @see LocationTypes
     */
    public $type;
}
