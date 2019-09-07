<?php

namespace Ced\ProductExtended\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class LikedProduct
 * @package Ced\ProductExtended\Model
 */
class LikedProduct extends AbstractModel
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Ced\ProductExtended\Model\ResourceModel\LikedProduct');
    }
}
