<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 12:36
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Country implements  XmlSerializable {
    private $identificationCode;

    private $name;

    /**
     * @return mixed
     */
    public function getIdentificationCode() {
        return $this->identificationCode;
    }

    /**
     * @param mixed $identificationCode
     * @return Country
     */
    public function setIdentificationCode($identificationCode) {
        $this->identificationCode = $identificationCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Country
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        $writer->write([
            Schema::CBC.'IdentificationCode' => $this->identificationCode,
            Schema::CBC.'Name' => $this->name,
        ]);
    }


}