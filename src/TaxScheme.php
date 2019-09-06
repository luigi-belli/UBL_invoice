<?php
/**
 * Created by PhpStorm.
 * User: baselbers
 * Date: 26-10-2017
 * Time: 20:28
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class TaxScheme implements XmlSerializable {
    private $id = 'VAT';

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return TaxScheme
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    function xmlSerialize(Writer $writer) {
        $writer->write([
            Schema::CBC.'ID' => $this->id
        ]);
    }
}