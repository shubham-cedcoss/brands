<?php
namespace Ced\Directory\Model;

use Magento\Framework\Model\AbstractModel;

class PortfolioImages extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Ced\Directory\Model\ResourceModel\PortfolioImages');
    }
}
