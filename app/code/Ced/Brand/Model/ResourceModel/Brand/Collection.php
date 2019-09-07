<?php

namespace Ced\Brand\Model\ResourceModel\Brand;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Ced\Brand\Model
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'brand_id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Ced\Brand\Model\Brand',
            'Ced\Brand\Model\ResourceModel\Brand'
        );
    }
}
