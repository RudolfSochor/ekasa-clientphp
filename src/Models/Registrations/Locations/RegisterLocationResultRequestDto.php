<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterResultRequestDto;

/**
 * Informácie o lokácií
 */
final class RegisterLocationResultRequestDto extends RegisterResultRequestDto
{
    /**
     * Informácie o evidencií polohy
     */
    public LocationRegistrationDataDto $data;

    /**
     * Unikátný identifikátor požiadavky
     * @see RegisterResultRequestDto
     */
    public string $id;

    /**
     * Externý unikátny identifikátor požiadavky
     * Identifikátor požiadavky alebo null
     * @see RegisterResultRequestDto
     */
    public ?string $externalId;

    /**
     * Dátum a čas odoslania požiadavky e-kasa klientom.
     * Pri opakovaných pokusoch o odoslanie môže byť neskorší,
     * ako dátum vytvorenia dátovej správy.
     * @see RegisterResultRequestDto
     * @example 2019-01-29T16:07:01+01:00
     */
    public ?\DateTime $date;

    /**
     * Poradové číslo pokusu o odoslanie požiadavky do systému e-kasa
     * @see RegisterResultRequestDto
     */
    public ?int $sendingCount;
}
