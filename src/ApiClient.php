<?php

namespace NineDigit\eKasa\Client;

use InvalidArgumentException;
use NineDigit\eKasa\Client\Exceptions\ProblemDetailsException;
use NineDigit\eKasa\Client\Exceptions\ValidationProblemDetailsException;
use NineDigit\eKasa\Client\Models\Certificates\CertificateDto;
use NineDigit\eKasa\Client\Models\Certificates\CertificateInfoDto;
use NineDigit\eKasa\Client\Models\Connectivity\ConnectivityMonitorStatusDto;
use NineDigit\eKasa\Client\Models\EKasaProductInfoDto;
use NineDigit\eKasa\Client\Models\Identities\IdentityDto;
use NineDigit\eKasa\Client\Models\IndexTable\IndexTableStatusDto;
use NineDigit\eKasa\Client\Models\Printers\OpenDrawerResultDto;
use NineDigit\eKasa\Client\Models\Printers\PrinterStatusDto;
use NineDigit\eKasa\Client\Models\Printers\PrintResultDto;
use NineDigit\eKasa\Client\Models\Printers\TextPrintContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\LocationRegistrationRequestDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptRequestContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptResultDto;
use NineDigit\eKasa\Client\Models\Storage\StorageInfoDto;

final class ApiClient
{
    private HttpClientInterface $httpClient;

    /**
     * @param $optionsOrClient ApiClientOptions | HttpClientInterface
     * Akceptuje ApiClientOptions alebo HttpClientInterface.
     * Preťaženie s HttpClientInterface sa využíva iba na testovacie účely. Využívajte preťaženie
     * akceptujúce ApiClientOptions.
     */
    public function __construct($optionsOrClient)
    {
        if ($optionsOrClient instanceof ApiClientOptions) {
            $this->httpClient = new HttpClient($optionsOrClient);
        } elseif (is_subclass_of($optionsOrClient, HttpClientInterface::class)) {
            $this->httpClient = $optionsOrClient;
        } else {
            throw new InvalidArgumentException(
                "Expecting " . ApiClientOptions::class
                . " or " . HttpClientInterface::class . " type as an argument."
            );
        }
    }

    // Certificates

    /**
     * @return CertificateInfoDto[]
     */
    public function getCertificates(?string $cashRegisterCode = null): array
    {
        $qs = array("cashRegisterCode" => $cashRegisterCode);
        $apiRequest = ApiRequestBuilder::createGet("/v1/certificates", $qs)->build();
        return $this->httpClient->receive($apiRequest, CertificateInfoDto::class);
    }

    /**
     * TODO
     * @return CertificateInfoDto
     */
    public function addCertificate(CertificateDto $certificate): CertificateInfoDto
    {
        $apiRequest = ApiRequestBuilder::createPost("/v1/certificates")
            ->withPayload($certificate)
            ->build();
        return $this->httpClient->receive($apiRequest, CertificateInfoDto::class);
    }

    /**
     * TODO
     */
    public function getLatestCertificate(
        string $cashRegisterCode
    ): CertificateInfoDto {
        $qs = array("cashRegisterCode" => $cashRegisterCode);
        $apiRequest = ApiRequestBuilder::
            createGet("/v1/certificates/latest", $qs)->build();
        return $this->httpClient->receive($apiRequest, CertificateInfoDto::class);
    }

    /**
     * TODO
     */
    public function getLatestValidCertificate(
        string $cashRegisterCode
    ): CertificateInfoDto {
        $qs = array("cashRegisterCode" => $cashRegisterCode);
        $apiRequest = ApiRequestBuilder::
            createGet("/v1/certificates/valid/latest", $qs)->build();
        return $this->httpClient->receive($apiRequest, CertificateInfoDto::class);
    }

    // Connectivity

    /**
     * TODO
     */
    public function getConnectivityStatus(): ConnectivityMonitorStatusDto
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/connectivity/status")
            ->build();
        return $this->httpClient
            ->receive($apiRequest, ConnectivityMonitorStatusDto::class);
    }

    // Identities

    /**
     * TODO
     */
    public function getAllIdentities(): array
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/identities")->build();
        return $this->httpClient->receive($apiRequest, IdentityDto::class);
    }

    /**
     * TODO
     */
    public function getIdentity(): array
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/identities")->build();
        return $this->httpClient->receive($apiRequest, IdentityDto::class);
    }

    /**
     * TODO
     */
    public function addIdentity(IdentityDto $identity): IdentityDto
    {
        $apiRequest = ApiRequestBuilder::createPost("/v1/identities")
            ->withPayload($identity)
            ->build();

        return $this->httpClient->receive($apiRequest, IdentityDto::class);
    }

     // IndexTable

     /**
      * TODO
      */
    public function getIndexTableStatus(): IndexTableStatusDto
    {
        $apiRequest = ApiRequestBuilder::
            createGet("/v1/index_table/status")->build();
        return $this->httpClient->receive($apiRequest, IndexTableStatusDto::class);
    }

    //Printers

    /**
     * TODO
     */
    public function getPrinterStatus(): PrinterStatusDto
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/printers/status")->build();
        return $this->httpClient->receive($apiRequest, PrinterStatusDto::class);
    }

    /**
     * TODO
     */
    public function addPrint(TextPrintContextDto $printed): PrintResultDto
    {
        $apiRequest = ApiRequestBuilder::createPost("/v1/printers/print")
            ->withPayload($printed)
            ->build();
        return $this->httpClient->receive($apiRequest, PrintResultDto::class);
    }
    public function addOpenDrawer(OpenDrawerResultDto $opened): OpenDrawerResultDto
    {
        $apiRequest = ApiRequestBuilder::createPost("/v1/printers/open_drawer")
            ->withPayload($opened)
            ->build();
        return $this->httpClient->receive($apiRequest, OpenDrawerResultDto::class);
    }

    /**
     * TODO
     */

    // Product

    /**
     * Získanie informácii o pokladničnom programe a aktuálne pripojenom
     * chránenom dátovom úložisku.
     */
    public function getProductInfo(): EKasaProductInfoDto
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/product/info")->build();
        return $this->httpClient->receive($apiRequest, EKasaProductInfoDto::class);
    }

    //Storage

    /**
     * TODO
     */
    public function getStorageInfo(): StorageInfoDto
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/storage/info")->build();
        return $this->httpClient->receive($apiRequest, StorageInfoDto::class);
    }

    // Registrations

    public function getLatestLocations(): array
    {
        $apiRequest = ApiRequestBuilder::createGet("/v1/requests/locations/current")->build();
        return $this->httpClient->receive($apiRequest, LocationRegistrationRequestDto::class);
    }

    /**
     * Zadá požiadavku na zaregistrovanie dokladu.
     * @throws ValidationProblemDetailsException ak nie je požiadavka valídna
     * @throws ProblemDetailsException
     * @throws ExposeException
     * @throws ApiAuthenticationException
     * @throws Exception
     */
    public function registerReceipt(
        RegisterReceiptRequestContextDto $context
    ): RegisterReceiptResultDto {
        $apiRequest = ApiRequestBuilder::createPost("/v1/requests/receipts")
            ->withPayload($context)
            ->build();
        return $this->httpClient->receive($apiRequest, RegisterReceiptResultDto::class);
    }
}
