<?php
/*
 * http://www.oioubl.info/classes/en/invoice.html
 * http://www.oioubl.net/validator/
 */


use CleverIt\UBL\Invoice\Invoice;
use CleverIt\UBL\Invoice\Generator;
use CleverIt\UBL\Invoice\LegalMonetaryTotal;
use CleverIt\UBL\Invoice\TaxSubTotal;
use CleverIt\UBL\Invoice\Address;
use CleverIt\UBL\Invoice\Country;
use CleverIt\UBL\Invoice\Party;
use CleverIt\UBL\Invoice\Item;
use CleverIt\UBL\Invoice\Price;
use CleverIt\UBL\Invoice\InvoiceLine;
use CleverIt\UBL\Invoice\TaxScheme;
use CleverIt\UBL\Invoice\TaxTotal;
use CleverIt\UBL\Invoice\TaxCategory;

require_once  __DIR__ . '/../vendor/autoload.php';

$generator          = new Generator();
$legalMonetaryTotal = new LegalMonetaryTotal();

// adress
$caddress = new Address();
$caddress->setStreetName('Résidence du chateau');
$caddress->setAdditionalStreetName(5);
$caddress->setCityName('Castle Land');
$caddress->setPostalZone('38760');
$country = new Country();
$country->setIdentificationCode('FR');
$caddress->setCountry($country);

// company
$company  = new Party();
$company->setName('Company Machin');
//$company->setPhysicalLocation($caddress);
$company->setPostalAddress($caddress);

// client
$client = new Party();
$client->setName('My client');
$client->setPostalAddress($caddress);

//product
$item   = new Item();
$item->setName('Product Name');
$item->setDescription('Product Description');

//price
$price= new Price();
$price->setBaseQuantity(1);
$price->setUnitCode('Unit');
$price->setPriceAmount(10);

//line
$invoiceLine = new InvoiceLine();
$invoiceLine->setId(0);
$invoiceLine->setItem($item);
$invoiceLine->setPrice($price);
$invoiceLine->setInvoicedQuantity(1);

$invoiceLines = array($invoiceLine);
// taxe TVA
$TaxScheme    = new TaxScheme();
$TaxScheme->setId(0);
$taxCategory = new TaxCategory();
$taxCategory->setId(0);
$taxCategory->setName('TVA20');
$taxCategory->setPercent(20);
$taxCategory->setTaxScheme($TaxScheme);

// taxes
$taxTotal    = new TaxTotal();
$taxSubTotal = new TaxSubTotal();
$taxSubTotal->setTaxableAmount(10);
$taxSubTotal->setTaxAmount(2);
$taxSubTotal->setTaxCategory($taxCategory);
$taxTotal->addTaxSubTotal($taxSubTotal);
$taxTotal->setTaxAmount($taxSubTotal->getTaxAmount());


// invoice
$invoice = new Invoice();
$invoice->setId(3);
$invoice->setIssueDate(new \DateTime());
$invoice->setInvoiceTypeCode('invoiceTypeCode');
$invoice->setAccountingSupplierParty($company);
$invoice->setAccountingCustomerParty($client);
$invoice->setInvoiceLines($invoiceLines);
$legalMonetaryTotal->setPayableAmount(10+2);
$legalMonetaryTotal->setAllowanceTotalAmount(0);
$invoice->setLegalMonetaryTotal($legalMonetaryTotal);
$invoice->setTaxTotal($taxTotal);

header("Content-type: text/xml");
print($generator->invoice($invoice));
