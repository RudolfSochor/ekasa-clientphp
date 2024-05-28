<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Informácie o evidencií polohy
 */
final class LocationRegistrationDataDto extends RegistrationDataDto
{
    /**
     * Poloha registračnej pokladne
     */
    public LocationDto $location;
}
