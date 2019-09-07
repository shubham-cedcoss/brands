<?php

namespace Ced\ProductExtended\Model\ResourceModel\LikedProduct;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class LikedProduct
 * @package Ced\ProductExtended\Model\ResourceModel\Collection
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Ced\ProductExtended\Model\LikedProduct',
            'Ced\ProductExtended\Model\ResourceModel\LikedProduct'
        );
    }
}
