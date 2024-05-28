<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Dátum spracovania po úspešnom zaevidovaní v systéme e-kasa
 */
final class RegisterResultResponseDto
{
    /**
     * Textový reťazec dátumu spracovania dokladu v kódovaní ISO 8601,
     * ak bol doklad úspešne zaevidovaný v systéme e-kasa, inak null
     * @example 2021-01-29T16:07:01+01:00
     */
    public \DateTime $processDate;
}
