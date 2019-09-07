<?php
namespace Ced\Directory\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PortfolioImages extends AbstractDb
{
    protected $_idFieldName = 'id';
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('portfolio_images', 'id'); //here "employee" is table name and "id" is the primary key of custom table
    }
}