<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 12:29
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Address implements XmlSerializable{
    private $streetName;
    private $additionalStreetName;
    private $cityName;
    private $postalZone;
    /**
     * @var Country
     */
    private $country;

    /**
     * @return mixed
     */
    public function getStreetName() {
        return $this->streetName;
    }

    /**
     * @param mixed $streetName
     * @return Address
     */
    public function setStreetName($streetName) {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdditionalStreetName() {
        return $this->additionalStreetName;
    }

    /**
     * @param mixed $additionalStreetName
     * @return Address
     */
    public function setAdditionalStreetName($additionalStreetName) {
        $this->additionalStreetName = $additionalStreetName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName() {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     * @return Address
     */
    public function setCityName($cityName) {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostalZone() {
        return $this->postalZone;
    }

    /**
     * @param mixed $postalZone
     * @return Address
     */
    public function setPostalZone($postalZone) {
        $this->postalZone = $postalZone;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return Address
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }


    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        $data = [
            Schema::CBC.'StreetName' => $this->streetName,
            Schema::CBC.'CityName' => $this->cityName,
            Schema::CBC.'PostalZone' => $this->postalZone,
            Schema::CAC.'Country' => $this->country,
        ];
        if (!empty($this->additionalStreetName)) {
            $data[Schema::CBC.'AdditionalStreetName'] = $this->additionalStreetName;
        }
        $writer->write($data);
    }
}