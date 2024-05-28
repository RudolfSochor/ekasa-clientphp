<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Výsledok zaevidovania dátovej správy.
 */
abstract class RegisterResultRequestDto
{
    /**
     * Unikátný identifikátor požiadavky
     */
    public string $id;

    /**
     * Externý unikátny identifikátor požiadavky
     * Identifikátor požiadavky alebo null
     */
    public ?string $externalId;

    /**
     * Dátum a čas odoslania požiadavky e-kasa klientom.
     * Pri opakovaných pokusoch o odoslanie môže byť neskorší,
     * ako dátum vytvorenia dátovej správy.
     * @example 2019-01-29T16:07:01+01:00
     */
    public \DateTime $date;

    /**
     * Poradové číslo pokusu o odoslanie požiadavky do systému e-kasa
     */
    public int $sendingCount;
}
