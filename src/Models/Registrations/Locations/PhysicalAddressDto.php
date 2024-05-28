<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Poloha prenosnej registračnej pokladne vo forme fyzickej adresy.
 */
final class PhysicalAddressDto extends LocationDto
{
    /**
     * Názov ulice
     */
    public string $streetName;

    /**
     * Názov obce
     */
    public string $municipality;

    /**
     * Číslo budovy
     */
    public string $buildingNumber;

    /**
     * Poštové smerovace číslo
     */
    public ?string $postalCode;

    /**
     * Číslo registrácie
     */
    public ?int $propertyRegistrationNumber;

    /**
     * Typ polohy
     */
    public $type = "Address";
}
