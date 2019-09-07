<?php
namespace Ced\Directory\Model\ResourceModel\Collection;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init(
            'Ced\Directory\Model\Directory',
            'Ced\Directory\Model\ResourceModel\Directory'
        );
    }
}
