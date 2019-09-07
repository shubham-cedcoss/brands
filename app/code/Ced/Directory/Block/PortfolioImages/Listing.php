<?php

namespace Ced\Directory\Block\PortfolioImages;

use Ced\Directory\Model\PortfolioImagesFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Listing extends Template
{
    protected $collectionFactory;
    protected $modelFactory;
    public $storeManager;

    public function __construct(
        Context $context,
        PortfolioImagesFactory $modelFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->modelFactory = $modelFactory;
        parent::__construct($context, $data);
    }

    public function getImageCollection()
    {
        $model = $this->modelFactory->create();
        $collection = $model->getCollection();
        return $collection;
    }

    public function getMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
