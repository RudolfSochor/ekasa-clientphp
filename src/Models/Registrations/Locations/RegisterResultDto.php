<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

use NineDigit\eKasa\Client\Models\Registrations\EKasaErrorDto;

/**
 * Výsledok zaevidovania dátovej správy.
 */
abstract class RegisterResultDto
{
    /**
     * Dáta požiadavky evidencie
    */
    public RegisterResultRequestDto $request;

    /**
     * Určuje, či požiadavka zaevidovania do systému e-Kasa skončila
     * úspšene (hodnota true), neúspešne (hodnota false), alebo sa
     * požiadavku doposiaľ nepodarilo odoslať (hodnota null).
     * @var bool|null
     */
    public ?bool $isSuccessful;

   /**
    * Obsahuje informácie o úspešnom spracovaní požiadavky.
    * Obsahuje hodnotu, iba ak ak $isSuccessful je true.
    * @var RegisterResultResponseDto|null
    */
    public ?RegisterResultResponseDto $response;
}
