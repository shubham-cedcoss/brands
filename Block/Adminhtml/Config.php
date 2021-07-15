<?php

namespace Ced\Brand\Block\Adminhtml;

use Ced\Brand\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Config
 * @package Ced\Brand\Block\adminhtml
 */
class Config extends Template
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * Config constructor.
     * @param Context $context
     * @param Data $helper
     */
    public function __construct(Context $context, Data $helper)
    {
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }
}
