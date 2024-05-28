<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Locations;

/**
 * Požiadavka evidencie polohy.
 */
final class RegisterLocationRequestDto
{
    /**
     * Poloha
     */
    public CashRegisterLocationDto $data;
}
