<?php
namespace Ced\Directory\Model\ResourceModel;

class Directory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'id';
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('employee', 'id'); //here "employee" is table name and "id" is the primary key of custom table
    }
}