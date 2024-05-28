<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Informácie o evidencií polohy
 */
abstract class RegistrationDataDto
{
    /**
     * Dátum a čas vytvorenia dokladu alebo záznamu o umiestnení prenosnej pokladnice v ORP.
     * Textový reťazec dátumu a času v kódovaní ISO 8601
     * @example 2019-01-29T16:07:01+01:00
     */
    public \DateTime $createDate;

    /**
     * Daňové identifikačné číslo
     * Texový reťazec pozostávajúci z 10 číslic
     * @example 1234567890
     */
    public string $dic;

    /**
     * Kód on-line registračnej pokladnice
     * Textový reťazec pozostávajúci z čísel s dĺžkou 16 alebo 17 znakov
     * @example 88812345678900001
     */
    public string $cashRegisterCode;
}
