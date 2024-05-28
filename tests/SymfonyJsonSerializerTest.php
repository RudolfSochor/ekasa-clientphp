<?php

namespace NineDigit\eKasa\Client\Tests;

use NineDigit\eKasa\Client\Models\QuantityDto;
use NineDigit\eKasa\Client\Models\Registrations\EKasaErrorDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\EmailReceiptPrinterOptions;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\EmailRegisterReceiptPrintContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\PdfReceiptPrinterOptions;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\PdfRegisterReceiptPrintContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\PosReceiptPrinterOptions;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\PosRegisterReceiptPrintContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptItemDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptItemType;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptPaymentDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptPaymentName;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptRegistrationDataDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptRegistrationResultReceiptDataDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptRequestContextDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptRequestDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptResultDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptResultRequestDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\RegisterReceiptResultResponseDto;
use NineDigit\eKasa\Client\Models\TaxFreeReason;
use PHPUnit\Framework\TestCase;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\ReceiptType;
use NineDigit\eKasa\Client\Models\SellerDto;
use NineDigit\eKasa\Client\Models\SellerIdType;
use NineDigit\eKasa\Client\ApiErrorCode;
use NineDigit\eKasa\Client\Models\Certificates\CertificateInfoDto;
use NineDigit\eKasa\Client\Models\Connectivity\ConnectivityMonitorStatusDto;
use NineDigit\eKasa\Client\Models\Identities\IdentityDto;
use NineDigit\eKasa\Client\Models\IndexTable\IndexTableStatusDto;
use NineDigit\eKasa\Client\Models\Printers\OpenDrawerResultDto;
use NineDigit\eKasa\Client\Models\Printers\PrinterStatus;
use NineDigit\eKasa\Client\Models\Printers\PrinterStatusDto;
use NineDigit\eKasa\Client\Models\Printers\PrintResultDto;
use NineDigit\eKasa\Client\Models\ProblemDetails;
use NineDigit\eKasa\Client\Models\Product\EKasaProductInfoDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\LocationDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\LocationRegistrationDataDto as LocationsLocationRegistrationDataDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\LocationRegistrationRequestDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\LocationRegistrationResposneDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\OtherLocationDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\RegisterLocationResultDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\RegisterLocationResultRequestDto;
use NineDigit\eKasa\Client\Models\Registrations\Locations\RegisterResultDto;
use NineDigit\eKasa\Client\Models\Registrations\Receipts\LocationRegistrationDataDto;
use NineDigit\eKasa\Client\Models\Storage\StorageInfoDto;
use NineDigit\eKasa\Client\Models\ValidationProblemDetails;
use NineDigit\eKasa\Client\Serialization\SymfonyJsonSerializer;
use phpDocumentor\Reflection\Types\Boolean;

final class SymfonyJsonSerializerTest extends TestCase
{
    public function testCertificateInfoDtoArrayDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '[
            {
                "alias": "88812345678900001",
                "cashRegisterCode": "88812345678900001",
                "issueDate": "2022-12-07T14:57:39+01:00",
                "expirationDate": "2024-12-06T14:57:39+01:00",
                "serialNumber": "013B27B82DDBEDD1F74606000000000000000045",
                "isExpired": false
            }
        ]';

        $a = $serializer->deserialize($json, CertificateInfoDto::class);

        $this->assertIsArray($a);
        $this->assertCount(1, $a);
        $this->assertInstanceOf(CertificateInfoDto::class, $a[0]);

        $this->assertEquals("88812345678900001", $a[0]->alias);
        $this->assertEquals("88812345678900001", $a[0]->cashRegisterCode);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2022, 12, 7, 14, 57, 39), $a[0]->issueDate);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 12, 6, 14, 57, 39), $a[0]->expirationDate);
        $this->assertEquals("013B27B82DDBEDD1F74606000000000000000045", $a[0]->serialNumber);
        $this->assertFalse($a[0]->isExpired);
    }

    public function testCertificateInfoDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "alias": "88812345678900001",
            "cashRegisterCode": "88812345678900001",
            "issueDate": "2022-12-07T14:57:39+01:00",
            "expirationDate": "2024-12-06T14:57:39+01:00",
            "serialNumber": "013B27B82DDBEDD1F74606000000000000000045",
            "isExpired": false
        }';

        $o = $serializer->deserialize($json, CertificateInfoDto::class);

        $this->assertInstanceOf(CertificateInfoDto::class, $o);
        $this->assertEquals("88812345678900001", $o->alias);
        $this->assertEquals("88812345678900001", $o->cashRegisterCode);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2022, 12, 7, 14, 57, 39), $o->issueDate);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 12, 6, 14, 57, 39), $o->expirationDate);
        $this->assertEquals("013B27B82DDBEDD1F74606000000000000000045", $o->serialNumber);
        $this->assertFalse($o->isExpired);
    }

    public function testConnectivityMonitorStatusDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "requestDate": "2024-05-23T09:06:03+02:00",
            "state": "Up"
        }';

        $o = $serializer->deserialize($json, ConnectivityMonitorStatusDto::class);

        $this->assertInstanceOf(ConnectivityMonitorStatusDto::class, $o);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 5, 23, 9, 6, 3), $o->requestDate);
        $this->assertEquals("Up", $o->state);
    }

    public function testIdentityDtoArrayDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '[
            {
                "dic": "1234567890",
                "ico": "76543210",
                "icdph": null,
                "corporateBodyFullName": "Finančná správa i.n.t.",
                "organizationUnit": {
                    "cashRegisterCode": "88812345678900001",
                    "cashRegisterType": "Portable",
                    "hasRegistrationException": false,
                    "organizationUnitName": "nepovinný názov predajne",
                    "physicalAddress": null
                },
                "physicalAddress": {
                    "country": "Slovenská republika",
                    "streetName": "Horná",
                    "municipality": "Štrkovec",
                    "buildingNumber": "7",
                    "propertyRegistrationNumber": "560",
                    "deliveryAddress": {
                        "postalCode": "98045"
                    }
                }
            }
        ]';

        $a = $serializer->deserialize($json, IdentityDto::class);

        $this->assertIsArray($a);
        $this->assertCount(1, $a);
        $this->assertInstanceOf(IdentityDto::class, $a[0]);
        $this->assertEquals("1234567890", $a[0]->dic);
        $this->assertEquals("76543210", $a[0]->ico);
        $this->assertNull($a[0]->icdph);
        $this->assertEquals("Finančná správa i.n.t.", $a[0]->corporateBodyFullName);
        $this->assertEquals("88812345678900001", $a[0]->organizationUnit->cashRegisterCode);
        $this->assertEquals("Portable", $a[0]->organizationUnit->cashRegisterType);
        $this->assertFalse($a[0]->organizationUnit->hasRegistrationException);
        $this->assertEquals("nepovinný názov predajne", $a[0]->organizationUnit->organizationUnitName);
        $this->assertNull($a[0]->organizationUnit->physicalAddress);
        $this->assertEquals("Slovenská republika", $a[0]->physicalAddress->country);
        $this->assertEquals("Horná", $a[0]->physicalAddress->streetName);
        $this->assertEquals("Štrkovec", $a[0]->physicalAddress->municipality);
        $this->assertEquals("7", $a[0]->physicalAddress->buildingNumber);
        $this->assertEquals("560", $a[0]->physicalAddress->propertyRegistrationNumber);
        $this->assertEquals("98045", $a[0]->physicalAddress->deliveryAddress->postalCode);
    }

    public function testIndexTableStatusDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "indexTableBlocksCount": 0,
            "storageBlocksCount": 0
        }';

        $o = $serializer->deserialize($json, IndexTableStatusDto::class);

        $this->assertInstanceOf(IndexTableStatusDto::class, $o);
        $this->assertEquals("0", $o->indexTableBlocksCount);
        $this->assertEquals("0", $o->storageBlocksCount);
    }

    public function testPrinterStatusDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "state": "Ready",
            "paperState": "Empty"
        }';

        $o = $serializer->deserialize($json, PrinterStatusDto::class);

        $this->assertInstanceOf(PrinterStatusDto::class, $o);
        $this->assertEquals("Ready", $o->state);
        $this->assertEquals("Empty", $o->paperState);
    }

    public function testPrintResultDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "printed": null
        }';

        $o = $serializer->deserialize($json, PrintResultDto::class);

        $this->assertInstanceOf(PrintResultDto::class, $o);
        $this->assertNull($o->printed);
    }

    public function testOpenDrawerResultDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "opened": false
        }';

        $o = $serializer->deserialize($json, OpenDrawerResultDto::class);

        $this->assertInstanceOf(OpenDrawerResultDto::class, $o);
        $this->assertFalse($o->opened);
    }

    public function testEKasaProductInfoDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "vendorName": "Nine Digit, s.r.o.",
            "swid": "e6ab3b6a8074a7ae8eb7b9f0c9949893aed9fefa",
            "ppekk": {
                "name": "Portos eKasa",
                "version": "v6.10"
            },
            "chdu": {
                "name": "Memory Record Repository",
                "version": "1.0"
            }
        }';

        $o = $serializer->deserialize($json, EKasaProductInfoDto::class);

        $this->assertInstanceOf(EKasaProductInfoDto::class, $o);
        $this->assertEquals("Nine Digit, s.r.o.", $o->vendorName);
        $this->assertEquals("e6ab3b6a8074a7ae8eb7b9f0c9949893aed9fefa", $o->swid);
        $this->assertEquals("Portos eKasa", $o->ppekk->name);
        $this->assertEquals("v6.10", $o->ppekk->version);
        $this->assertEquals("Memory Record Repository", $o->chdu->name);
        $this->assertEquals("1.0", $o->chdu->version);
    }

    public function testStorageInfoDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "product": {
                "vendorName": "Nine Digit, s.r.o.",
                "name": "Memory Record Repository",
                "version": "1.0",
                "serialNumber": "-"
            },
            "capacity": {
                "total": 9223372036854775807,
                "used": 0
            },
            "isReadOnly": false
        }';

        $o = $serializer->deserialize($json, StorageInfoDto::class);

        $this->assertInstanceOf(StorageInfoDto::class, $o);
        $this->assertEquals("Nine Digit, s.r.o.", $o->product->vendorName);
        $this->assertEquals("Memory Record Repository", $o->product->name);
        $this->assertEquals("1.0", $o->product->version);
        $this->assertEquals("-", $o->product->serialNumber);
        $this->assertEquals("9223372036854775807", $o->capacity->total);
        $this->assertEquals("0", $o->capacity->used);
        $this->assertFalse($o->isReadOnly);
    }

    public function testLocationRegistrationDataDtoArrayDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '[
            {
                "request": {
                    "data": {
                        "location": {
                            "longitude": 17.165377,
                            "latitude": 48.148962,
                            "$type": "GPS"
                        },
                        "createDate": "2024-05-27T09:11:32+02:00",
                        "dic": "1234567890",
                        "cashRegisterCode": "88812345678900001"
                    },
                    "id": "d25c7a84-3f84-4b19-88f3-84387b7cf351",
                    "externalId": "0afa4ca5-26d5-41d8-a485-cf2ad0e7d6f0",
                    "date": "2024-05-27T09:11:32+02:00",
                    "sendingCount": 1
                },
                "response": {
                    "processDate": "2024-05-27T09:11:32+02:00"
                },
                "isSuccessful": true,
                "error": {
                    "message": "ERROR",
                    "code": 123
                },
                "$type": "Location"
            }
        ]';

        $a = $serializer->deserialize($json, RegisterLocationResultDto::class);

        $this->assertIsArray($a);
        $this->assertCount(1, $a);
        $this->assertInstanceOf(RegisterLocationResultDto::class, $a[0]);

        $this->assertEquals(17.165377, $a[0]->request->data->location->longitude);
        $this->assertEquals(48.148962, $a[0]->request->data->location->latitude);
        $this->assertEquals("GPS", $a[0]->request->data->location->type);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 5, 27, 9, 11, 32), $a[0]->request->data->createDate);
        $this->assertEquals("1234567890", $a[0]->request->data->dic);
        $this->assertEquals("88812345678900001", $a[0]->request->data->cashRegisterCode);
        $this->assertEquals("d25c7a84-3f84-4b19-88f3-84387b7cf351", $a[0]->request->id);
        $this->assertEquals("0afa4ca5-26d5-41d8-a485-cf2ad0e7d6f0", $a[0]->request->externalId);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 5, 27, 9, 11, 32), $a[0]->request->date);
        $this->assertEquals(1, $a[0]->request->sendingCount);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2024, 5, 27, 9, 11, 32), $a[0]->response->processDate);
        $this->assertTrue($a[0]->isSuccessful);
        $this->assertEquals("ERROR", $a[0]->error->message);
        $this->assertEquals(123, $a[0]->error->code);
        $this->assertEquals("Location", $a[0]->type);
    }

    public function testGeoCoordinatesDtoAsLocationDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "longitude": 17.165377,
            "latitude": 48.148962,
            "$type": "GPS"
        }';

        $o = $serializer->deserialize($json, LocationDto::class);

        $this->assertInstanceOf(LocationDto::class, $o);
        $this->assertEquals(17.165377, $o->longitude);
        $this->assertEquals(48.148962, $o->latitude);
    }

    public function testPhysicalAddressDtoAsLocationDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "streetName": "Horná",
            "municipality": "Štrkovec",
            "buildingNumber": "7",
            "postalCode": "98045",
            "propertyRegistrationNumber": 560,
            "$type": "Address"
        }';

        $o = $serializer->deserialize($json, LocationDto::class);

        $this->assertInstanceOf(LocationDto::class, $o);
        $this->assertEquals("Horná", $o->streetName);
        $this->assertEquals("Štrkovec", $o->municipality);
        $this->assertEquals("7", $o->buildingNumber);
        $this->assertEquals("98045", $o->postalCode);
        $this->assertEquals("560", $o->propertyRegistrationNumber);
    }

    public function testOtherLocationDtoAsLocationDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $json = '{
            "value": "Taxi ABC EČ vozidla = BA 123 AA; odpočívadlo Zeleneč D1",
            "$type": "Other"
        }';

        $o = $serializer->deserialize($json, LocationDto::class);

        $this->assertInstanceOf(LocationDto::class, $o);
        $this->assertEquals("Taxi ABC EČ vozidla = BA 123 AA; odpočívadlo Zeleneč D1", $o->value);
        var_dump($o);
    }

    public function testReceiptDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();

        $receipt = new ReceiptDto();
        $receipt->cashRegisterCode = "88812345678900001";
        $receipt->receiptType = ReceiptType::CASH_REGISTER;
        $receipt->issueDate = DateTimeHelper::createEuropeBratislava(2023, 9, 11, 18, 14, 11);
        $receipt->invoiceNumber = "201801001";
        $receipt->paragonNumber = 429;
        $receipt->amount = 3.50;
        $receipt->roundingAmount = 0.04;
        $receipt->headerText = "Nine Digit, s.r.o.";
        $receipt->footerText = "Ďakujeme za nákup!";

        $itemSeller = new SellerDto();
        $itemSeller->id = "SK1234567890";
        $itemSeller->type = SellerIdType::ICDPH;

        $receipt->items = array(
            new ReceiptItemDto(
                ReceiptItemType::POSITIVE,
                "Coca Cola 0.25l",
                1.29,
                20.00,
                new QuantityDto(2.0000, "ks"),
                2.58,
                "Akcia",
                $itemSeller,
                TaxFreeReason::USED_GOOD,
                "201801001",
                "O-7DBCDA8A56EE426DBCDA8A56EE426D1A"
            )
        );
        $receipt->payments = array(
            new ReceiptPaymentDto(3.50, ReceiptPaymentName::CASH)
        );

        $json = $serializer->serialize($receipt);
        $data = json_decode($json, true);

        $this->assertIsArray($data);

        $this->assertEquals(ReceiptType::CASH_REGISTER, $data["receiptType"]);
        $this->assertEquals("2023-09-11T18:14:11+02:00", $data["issueDate"]);
        $this->assertEquals("201801001", $data["invoiceNumber"]);
        $this->assertEquals(429, $data["paragonNumber"]);

        $this->assertIsArray($data["items"]);
        $this->assertEquals(1, count($data["items"]));

        $this->assertIsArray($data["items"][0]);
        $this->assertEquals(ReceiptItemType::POSITIVE, $data["items"][0]["type"]);
        $this->assertEquals("Coca Cola 0.25l", $data["items"][0]["name"]);
        $this->assertEquals(2.58, $data["items"][0]["price"]);
        $this->assertEquals(1.29, $data["items"][0]["unitPrice"]);

        $this->assertIsArray($data["items"][0]["quantity"]);
        $this->assertEquals(2, $data["items"][0]["quantity"]["amount"]);
        $this->assertEquals("ks", $data["items"][0]["quantity"]["unit"]);

        $this->assertEquals(20, $data["items"][0]["vatRate"]);
        $this->assertEquals("O-7DBCDA8A56EE426DBCDA8A56EE426D1A", $data["items"][0]["referenceReceiptId"]);
        $this->assertEquals("UsedGood", $data["items"][0]["specialRegulation"]);
        $this->assertEquals("201801001", $data["items"][0]["voucherNumber"]);

        $this->assertIsArray($data["items"][0]["seller"]);
        $this->assertEquals("SK1234567890", $data["items"][0]["seller"]["id"]);
        $this->assertEquals("ICDPH", $data["items"][0]["seller"]["type"]);

        $this->assertEquals("Akcia", $data["items"][0]["description"]);

        $this->assertIsArray($data["payments"]);
        $this->assertEquals(1, count($data["payments"]));

        $this->assertIsArray($data["payments"][0]);
        $this->assertEquals(ReceiptPaymentName::CASH, $data["payments"][0]["name"]);
        $this->assertEquals(3.5, $data["payments"][0]["amount"]);

        $this->assertEquals(3.5, $data["amount"]);
        $this->assertEquals(0.04, $data["roundingAmount"]);
        $this->assertEquals("Nine Digit, s.r.o.", $data["headerText"]);
        $this->assertEquals("Ďakujeme za nákup!", $data["footerText"]);
        $this->assertEquals("88812345678900001", $data["cashRegisterCode"]);
    }

    public function testRegisterReceiptRequestDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $request = new RegisterReceiptRequestDto(new ReceiptDto(), "EID-0094736");

        $json = $serializer->serialize($request);
        $data = json_decode($json, true);

        $this->assertIsArray($data);
        $this->assertIsArray($data["data"]);
        $this->assertEquals("EID-0094736", $data["externalId"]);
    }

    public function testRegisterReceiptRequestContextDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $request = new RegisterReceiptRequestContextDto(
            new PosRegisterReceiptPrintContextDto(),
            new RegisterReceiptRequestDto(new ReceiptDto())
        );

        $json = $serializer->serialize($request);
        $data = json_decode($json, true);

        $this->assertIsArray($data);
        $this->assertIsArray($data["print"]);
        $this->assertIsArray($data["request"]);
    }

    public function testPosRegisterReceiptPrintContextDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();

        $opts = new PosReceiptPrinterOptions();
        $opts->openDrawer = true;
        $opts->printLogo = true;
        $opts->logoMemoryAddress = 2;

        $context = new PosRegisterReceiptPrintContextDto($opts);

        $json = $serializer->serialize($context);
        $data = json_decode($json, true);

        $this->assertIsArray($data);
        $this->assertEquals("pos", $data["printerName"]);
        $this->assertIsArray($data["options"]);
        $this->assertTrue($data["options"]["openDrawer"]);
        $this->assertTrue($data["options"]["printLogo"]);
        $this->assertEquals(2, $data["options"]["logoMemoryAddress"]);
    }

    public function testPdfRegisterReceiptPrintContextDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();

        $opts = new PdfReceiptPrinterOptions();
        $context = new PdfRegisterReceiptPrintContextDto($opts);

        $json = $serializer->serialize($context);
        $data = json_decode($json, true);

        $this->assertIsArray($data);
        $this->assertEquals("pdf", $data["printerName"]);
        $this->assertIsArray($data["options"]);
    }

    public function testEmailRegisterReceiptPrintContextDtoSerialization()
    {
        $serializer = new SymfonyJsonSerializer();

        $opts = new EmailReceiptPrinterOptions();
        $opts->to = "mail@dispostable.com";
        $opts->recipientDisplayName = "John Doe";
        $opts->subject = "Your receipt";
        $opts->body = "See your attachment";

        $context = new EmailRegisterReceiptPrintContextDto($opts);

        $json = $serializer->serialize($context);
        $data = json_decode($json, true);

        $this->assertIsArray($data);
        $this->assertEquals("email", $data["printerName"]);
        $this->assertIsArray($data["options"]);
        $this->assertEquals("mail@dispostable.com", $data["options"]["to"]);
        $this->assertEquals("John Doe", $data["options"]["recipientDisplayName"]);
        $this->assertEquals("Your receipt", $data["options"]["subject"]);
        $this->assertEquals("See your attachment", $data["options"]["body"]);
    }

    public function testRegisterReceiptResultDtoDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $type = RegisterReceiptResultDto::class;

        $json = '{
    "request": {
        "data": {
            "receiptType": "CashRegister",
            "amount": 3.50,
            "roundingAmount": 0.02,
            "issueDate": "2023-09-11T18:14:11+02:00",
            "receiptNumber": 6,
            "invoiceNumber": "201801001",
            "paragonNumber": 429,
            "icdph": "SK1234567890",
            "ico": "76543210",
            "customer": {
                "id": "2004567890",
                "type": "ICO"
            },
            "basicVatAmount": 0.58,
            "reducedVatAmount": 0.00,
            "taxFreeAmount": 0.00,
            "taxBaseBasic": 2.90,
            "taxBaseReduced": 0.00,
            "items": [{
                "type": "Positive",
                "name": "Coca Cola 0.25l",
                "price": 2.58,
                "unitPrice": 1.29,
                "quantity": {
                    "amount": 2.0000,
                    "unit": "ks"
                },
                "referenceReceiptId": "O-7DBCDA8A56EE426DBCDA8A56EE426D1A",
                "vatRate": 20.00,
                "specialRegulation": "UsedGood",
                "voucherNumber": "201801001",
                "seller": {
                    "id": "SK1234567890",
                    "type": "ICDPH"
                },
                "description": "Tovar"
            }],
            "okp": "4a6f100d-72e25fee-494d5ea0-d00b7bb8-166ab88a",
            "pkp": "OhI/bUdkSi9hRXsBm6Hymv9tKo9Yo2ZULuxSiLlHMXhlwmRHoQLnMmehnqs68m6iH3juPR/5r9wiAuuY/dOigTrd70dRLbHtGU4PNeI+IIC/2VUFucN2kfl4Ehx5jzBGVAWxAbESX40SN2RskRXK8hXze954YN01feTlq+FLtYW7hp25ckWUYSRN1StpNEv8Klm2qQ62U51VzKc1Xo5RoWoB7ZUydnDKkDyWUT1Vw/Eg/k8a/4Hk+Xrd+Vn1gXGSvYmkGBDHdC7aTp87FQ/NtjvJDF0embjqzJpBqkmafu9fsUL/fqNU/ygV8VLbbBd7SyzyyAUBLAhXdtWaPDWBYA==",
            "payments": [{
                "name": "Hotovosť",
                "amount": 3.50
            }],
            "headerText": "Nine Digit, s.r.o.",
            "footerText": "Ďakujeme za nákup!",
            "createDate": "2023-09-11T18:14:11+02:00",
            "dic": "1234567890",
            "cashRegisterCode": "88812345678900001"
        },
        "id": "f00d1cea-6d8d-46ac-9877-09ca29f90ef5",
        "externalId": "EID-0094736",
        "date": "2023-09-11T18:14:11+02:00",
        "sendingCount": 1
    },
    "response": {
        "data": {
            "id": "O-0A3730BF772041C9B730BF77205-TEST"
        },
        "processDate": "2023-09-11T18:14:12+02:00"
    },
    "isSuccessful": true,
    "error": {
        "message": "Chyba v podpise dátovej správy.",
        "code": -10
    },
    "$type": "Receipt"
}';

        $result = $serializer->deserialize($json, $type);

        $this->assertInstanceOf(RegisterReceiptResultDto::class, $result);
        $this->assertInstanceOf(RegisterReceiptResultRequestDto::class, $result->request);
        $this->assertInstanceOf(ReceiptRegistrationDataDto::class, $result->request->data);

        $this->assertEquals(ReceiptType::CASH_REGISTER, $result->request->data->receiptType);
        $this->assertEquals(3.50, $result->request->data->amount);
        $this->assertEquals(0.02, $result->request->data->roundingAmount);
        $this->assertEquals(
            DateTimeHelper::createEuropeBratislava(2023, 9, 11, 18, 14, 11),
            $result->request->data->issueDate
        );
        $this->assertEquals(6, $result->request->data->receiptNumber);
        $this->assertEquals("201801001", $result->request->data->invoiceNumber);
        $this->assertEquals(429, $result->request->data->paragonNumber);
        $this->assertEquals("SK1234567890", $result->request->data->icdph);
        $this->assertEquals("76543210", $result->request->data->ico);
        $this->assertEquals(0.58, $result->request->data->basicVatAmount);
        $this->assertEquals(0.00, $result->request->data->reducedVatAmount);
        $this->assertEquals(0.00, $result->request->data->reducedVatAmount);
        $this->assertEquals(0.00, $result->request->data->taxFreeAmount);
        $this->assertEquals(2.90, $result->request->data->taxBaseBasic);
        $this->assertEquals(0.00, $result->request->data->taxBaseReduced);
        $this->assertEquals("4a6f100d-72e25fee-494d5ea0-d00b7bb8-166ab88a", $result->request->data->okp);
        $this->assertEquals("OhI/bUdkSi9hRXsBm6Hymv9tKo9Yo2ZULuxSiLlHMXhlwmRHoQLnMmehnqs68m6iH3juPR/5r9wiAuuY/dOigTrd70dRLbHtGU4PNeI+IIC/2VUFucN2kfl4Ehx5jzBGVAWxAbESX40SN2RskRXK8hXze954YN01feTlq+FLtYW7hp25ckWUYSRN1StpNEv8Klm2qQ62U51VzKc1Xo5RoWoB7ZUydnDKkDyWUT1Vw/Eg/k8a/4Hk+Xrd+Vn1gXGSvYmkGBDHdC7aTp87FQ/NtjvJDF0embjqzJpBqkmafu9fsUL/fqNU/ygV8VLbbBd7SyzyyAUBLAhXdtWaPDWBYA==", $result->request->data->pkp);
        $this->assertEquals("Nine Digit, s.r.o.", $result->request->data->headerText);
        $this->assertEquals("Ďakujeme za nákup!", $result->request->data->footerText);
        $this->assertEquals(
            DateTimeHelper::createEuropeBratislava(2023, 9, 11, 18, 14, 11),
            $result->request->data->createDate
        );
        $this->assertEquals("1234567890", $result->request->data->dic);
        $this->assertEquals("88812345678900001", $result->request->data->cashRegisterCode);

        // Items
        $this->assertIsArray($result->request->data->items);
        $this->assertCount(1, $result->request->data->items);

        // Item[0]
        $this->assertInstanceOf(ReceiptItemDto::class, $result->request->data->items[0]);
        $this->assertEquals(ReceiptItemType::POSITIVE, $result->request->data->items[0]->type);
        $this->assertEquals("Coca Cola 0.25l", $result->request->data->items[0]->name);
        $this->assertEquals(2.58, $result->request->data->items[0]->price);
        $this->assertEquals(1.29, $result->request->data->items[0]->unitPrice);
        $this->assertInstanceOf(QuantityDto::class, $result->request->data->items[0]->quantity);
        $this->assertEquals(2.0000, $result->request->data->items[0]->quantity->amount);
        $this->assertEquals("ks", $result->request->data->items[0]->quantity->unit);
        $this->assertEquals("O-7DBCDA8A56EE426DBCDA8A56EE426D1A", $result->request->data->items[0]->referenceReceiptId);
        $this->assertEquals(20.00, $result->request->data->items[0]->vatRate);
        $this->assertEquals("UsedGood", $result->request->data->items[0]->specialRegulation);
        $this->assertEquals("201801001", $result->request->data->items[0]->voucherNumber);
        $this->assertInstanceOf(SellerDto::class, $result->request->data->items[0]->seller);
        $this->assertEquals("SK1234567890", $result->request->data->items[0]->seller->id);
        $this->assertEquals(SellerIdType::ICDPH, $result->request->data->items[0]->seller->type);
        $this->assertEquals("Tovar", $result->request->data->items[0]->description);

        // Payments
        $this->assertIsArray($result->request->data->payments);
        $this->assertCount(1, $result->request->data->payments);

        // Payment[0]
        $this->assertInstanceOf(ReceiptPaymentDto::class, $result->request->data->payments[0]);
        $this->assertEquals("Hotovosť", $result->request->data->payments[0]->name);
        $this->assertEquals(3.50, $result->request->data->payments[0]->amount);

        $this->assertEquals("f00d1cea-6d8d-46ac-9877-09ca29f90ef5", $result->request->id);
        $this->assertEquals("EID-0094736", $result->request->externalId);
        $this->assertEquals(DateTimeHelper::createEuropeBratislava(2023, 9, 11, 18, 14, 11), $result->request->date);
        $this->assertEquals(1, $result->request->sendingCount);

        $this->assertInstanceOf(RegisterReceiptResultResponseDto::class, $result->response);
        $this->assertInstanceOf(ReceiptRegistrationResultReceiptDataDto::class, $result->response->data);
        $this->assertEquals("O-0A3730BF772041C9B730BF77205-TEST", $result->response->data->id);
        $this->assertEquals(
            DateTimeHelper::createEuropeBratislava(2023, 9, 11, 18, 14, 12),
            $result->response->processDate
        );

        $this->assertTrue(true, $result->isSuccessful);
        $this->assertInstanceOf(EKasaErrorDto::class, $result->error);
        $this->assertEquals("Chyba v podpise dátovej správy.", $result->error->message);
        $this->assertEquals(-10, $result->error->code);
    }

    public function testValidationProblemDetailsDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $type = ValidationProblemDetails::class;

        $json = '{
      "errors": {
          "Request.Items": [
              "\'Items\' must not be empty."
          ]
      },
      "type": "https://tools.ietf.org/html/rfc7231#section-6.5.1",
      "title": "One or more validation errors occurred.",
      "status": 400,
      "traceId": "00-3883c3382a81f24ca6ac58a375d6de64-d99c7a32e359d24f-00"
    }';

        $details = $serializer->deserialize($json, $type);

        $this->assertInstanceOf(ValidationProblemDetails::class, $details);

        $this->assertIsArray($details->errors);
        $this->assertCount(1, $details->errors);
        $this->assertArrayHasKey("Request.Items", $details->errors);
        $this->assertIsArray($details->errors["Request.Items"]);
        $this->assertCount(1, $details->errors["Request.Items"]);
        $this->assertEquals("'Items' must not be empty.", $details->errors["Request.Items"][0]);

        $this->assertEquals("https://tools.ietf.org/html/rfc7231#section-6.5.1", $details->type);
        $this->assertEquals("One or more validation errors occurred.", $details->title);
        $this->assertEquals(400, $details->status);
        $this->assertEquals("00-3883c3382a81f24ca6ac58a375d6de64-d99c7a32e359d24f-00", $details->traceId);
    }

    public function testProblemDetailsDeserialization()
    {
        $serializer = new SymfonyJsonSerializer();
        $type = ProblemDetails::class;

        $json = '{
      "title": "General error",
      "status": 403,
      "instance": "/api/v1/requests/receipts",
      "code": -100,
      "traceId": "0HMCTVDF5NB0B:00000002"
    }';

        $details = $serializer->deserialize($json, $type);

        $this->assertInstanceOf(ProblemDetails::class, $details);

        $this->assertEquals("General error", $details->title);
        $this->assertEquals(403, $details->status);
        $this->assertEquals("/api/v1/requests/receipts", $details->instance);
        $this->assertEquals(ApiErrorCode::GENERAL_ERROR, $details->code);
        $this->assertEquals("0HMCTVDF5NB0B:00000002", $details->traceId);
    }
}
