<?php

namespace Ced\Directory\Model\ResourceModel\PortfolioImages;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Ced\Directory\Model\PortfolioImages',
            'Ced\Directory\Model\ResourceModel\PortfolioImages'
        );
    }
}
