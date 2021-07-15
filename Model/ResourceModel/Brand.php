<?php

namespace Ced\Brand\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Brand
 * @package Ced\Brand\Model\ResourceModel
 */
class Brand extends AbstractDb
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
        $this->_init('brands', 'brand_id');
    }
}
