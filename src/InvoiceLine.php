<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 14:17
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class InvoiceLine implements XmlSerializable {
    private $id;
    private $invoicedQuantity;
    private $lineExtensionAmount;
    private $accountingCostCode;

    /**
     * @var AllowanceCharge[]
     */
    private $allowanceCharges;

    /**
     * @var TaxTotal
     */
    private $taxTotal;

    /**
     * @var Item
     */
    private $item;
    /**
     * @var Price
     */
    private $price;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return InvoiceLine
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInvoicedQuantity() {
        return $this->invoicedQuantity;
    }

    /**
     * @param mixed $invoicedQuantity
     * @return InvoiceLine
     */
    public function setInvoicedQuantity($invoicedQuantity) {
        $this->invoicedQuantity = $invoicedQuantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLineExtensionAmount() {
        return $this->lineExtensionAmount;
    }

    /**
     * @param mixed $lineExtensionAmount
     * @return InvoiceLine
     */
    public function setLineExtensionAmount($lineExtensionAmount) {
        $this->lineExtensionAmount = $lineExtensionAmount;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxTotal() {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return InvoiceLine
     */
    public function setTaxTotal($taxTotal) {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * @param mixed $item
     * @return InvoiceLine
     */
    public function setItem($item) {
        $this->item = $item;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param Price $price
     * @return InvoiceLine
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges() {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge[] $allowanceCharges
     * @return InvoiceLine
     */
    public function setAllowanceCharges($allowanceCharges) {
        $this->allowanceCharges = $allowanceCharges;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountingCostCode()
    {
        return $this->accountingCostCode;
    }

    /**
     * @param mixed $accountingCostCode
     * @return InvoiceLine
     */
    public function setAccountingCostCode($accountingCostCode)
    {
        $this->accountingCostCode = $accountingCostCode;

        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        $writer->write([
            Schema::CBC . 'ID' => $this->id,
            [
                'name' => Schema::CBC . 'InvoicedQuantity',
                'value' => $this->invoicedQuantity
            ],
            [
                'name' => Schema::CBC . 'LineExtensionAmount',
                'value' => number_format($this->lineExtensionAmount, 2, '.', ''),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ],
            Schema::CAC . 'Item' => $this->item,
        ]);

        if (!empty($this->accountingCostCode)) {
            $writer->write(
                [
                    Schema::CBC . 'AccountingCostCode' => $this->accountingCostCode
                ]
            );
        }

        if ($this->allowanceCharges != null) {
            foreach ($this->allowanceCharges as $allowanceCharge) {
                $writer->write([
                    Schema::CAC . 'AllowanceCharge' => $allowanceCharge
                ]);
            }
        }

        if (!empty($this->taxTotal)) {
            $writer->write(
                [
                    Schema::CAC . 'TaxTotal' => $this->taxTotal
                ]
            );
        }

        if ($this->price !== null) {
            $writer->write(
                [
                    Schema::CAC . 'Price' => $this->price
                ]
            );
        }
    }
}
