<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 16:51
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Price implements XmlSerializable {
    private $priceAmount;
    private $baseQuantity;

    /**
     * @return mixed
     */
    public function getPriceAmount() {
        return $this->priceAmount;
    }

    /**
     * @param mixed $priceAmount
     * @return Price
     */
    public function setPriceAmount($priceAmount) {
        $this->priceAmount = $priceAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBaseQuantity() {
        return $this->baseQuantity;
    }

    /**
     * @param mixed $baseQuantity
     * @return Price
     */
    public function setBaseQuantity($baseQuantity) {
        $this->baseQuantity = $baseQuantity;
        return $this;
    }



    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        $data = [            [
            'name' => Schema::CBC.'PriceAmount',
            'value' => $this->priceAmount,
            'attributes' => [
                'currencyID' => Generator::$currencyID
            ]
        ]];
        if (!empty($this->baseQuantity)) {
            $data[] = [
                'name' => Schema::CBC.'BaseQuantity',
                'value' => $this->baseQuantity
            ];
        }
        $writer->write($data);
    }
}