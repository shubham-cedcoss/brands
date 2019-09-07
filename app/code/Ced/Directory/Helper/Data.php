<?php

namespace Ced\Directory\Helper;

use Magento\Directory\Model\Config\Source\Country;

class Data
{
    protected $country;

    /**
     * Data constructor.
     * @param \Magento\Directory\Model\Config\Source\Country $country
     */

    public function __construct(
        \Magento\Directory\Model\Config\Source\Country $country
    ) {
        $this->country = $country;
    }

    public function getCountries()
    {
        $return = [];
        foreach ($this->country->toOptionArray() as $item) {
            $return[$item['value']] = $item['label'];
        }
        return $return;
    }
    /*public function getStatus()
    {
        if ('status'==0) {
            $status = 'Disable';
        } else {
            $status = 'Enable';
        }
        return $status;
    }*/
}
