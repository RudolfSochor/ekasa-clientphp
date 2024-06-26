<?php

namespace NineDigit\eKasa\Client\Models;

/**
 * Identifikácia predávajúceho
 */
final class SellerDto
{
    /**
     * Identifikátor predávajúceho, v ktorého mene bol predaný tovar alebo poskytnutá služba.
     */
    public string $id;
    /**
     * Typ identifikátora predávajúceho, v ktorého mene bol predaný tovar alebo poskytnutá služba.
     * @see SellerIdType.
     */
    public string $type;
}
