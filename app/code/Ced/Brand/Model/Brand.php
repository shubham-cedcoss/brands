<?php

namespace Ced\Brand\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Brand
 * @package Ced\Brand\Model
 */
class Brand extends AbstractModel
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Ced\Brand\Model\ResourceModel\Brand');
    }
}
