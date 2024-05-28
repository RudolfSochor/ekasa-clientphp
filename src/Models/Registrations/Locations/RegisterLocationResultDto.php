<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

use NineDigit\eKasa\Client\Models\Registrations\EKasaErrorDto;

/**
 * Výsledok zaevidovania dokladu
 */
final class RegisterLocationResultDto
{
    /**
     * Dáta požiadavky evidencie
     */
    public RegisterLocationResultRequestDto $request;

    /**
     * Obsahuje informácie o úspešnom spracovaní požiadavky.
     * Obsahuje hodnotu, iba ak ak @see RegisterResultDTO.IsSuccessful je true.
     */
    public RegisterResultResponseDto $response;

    /**
     * Úspešnosť spracovania požiadavky
     */
    public bool $isSuccessful;

    /**
     * Obsahuje informácie o chybe pri spracovaní požiadavky.
     * Obsahuje hodnotu, iba ak ak $isSuccessful je false.
     * @var EKasaErrorDto|null
     */
    public ?EKasaErrorDto $error;

    public $type = "Location";
}
