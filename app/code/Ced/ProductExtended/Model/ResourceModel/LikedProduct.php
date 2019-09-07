<?php

namespace Ced\ProductExtended\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LikedProduct
 * @package Ced\ProductExtended\Model\ResourceModel
 */
class LikedProduct extends AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('liked_product', 'id');
    }
}
