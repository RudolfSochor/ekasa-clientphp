<?php

namespace NineDigit\eKasa\Client\Models\Registrations\Receipts;

/**
 * Objekt nastavení tlače papierového dokladu.
 */
final class PosReceiptPrinterOptions extends ReceiptPrinterOptions
{
  /**
   * Nepovinný príznak otvorenia peňažnej zásuvky. Ak je uvedený (nie null),
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   */
    public ?bool $openDrawer;
  /**
   * Nepovinný príznak tlače grafického loga. Ak je uvedený (nie null),
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   */
    public ?bool $printLogo;
  /**
   * Nepovinná adresa tlače grafického loga. Ak je uvedená (nie null),
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   * Hodnota predstavuje číslo v rozsahu 0-255.
   */
    public ?int $logoMemoryAddress;

    public function __construct(
        ?bool $openDrawer = null,
        ?bool $printLogo = null,
        ?int $logoMemoryAddress = null
    ) {
        $this->openDrawer = $openDrawer;
        $this->printLogo = $printLogo;
        $this->logoMemoryAddress = $logoMemoryAddress;
    }
}
