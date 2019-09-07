<?php

namespace Ced\Brand\Model\ResourceModel\DeletedBrands;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'brand_id';

    protected function _construct()
    {
        $this->_init(
            'Ced\Brand\Model\DeletedBrand',
            'Ced\Brand\Model\ResourceModel\DeletedBrand'
        );
    }
}
