<?php

namespace Ced\ProductExtended\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Edit
 * @package Ced\ProductExtended\Block
 */
class Edit extends Template
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var StoreManagerInterface
     */
    public $storeManager;

    private $remoteAddress;

    /**
     * Edit constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param ProductFactory $productFactory
     * @param RemoteAddress $remoteAddress
     * @param Http $request
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        ProductFactory $productFactory,
        RemoteAddress $remoteAddress,
        Http $request
    ) {
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->productFactory = $productFactory;
        $this->remoteAddress = $remoteAddress;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getIdValue()
    {
        return $this->request->getParam('id');
    }

    /**
     * @param $id
     * @return Product
     */
    public function getProductById($id)
    {
        return $this->productFactory->create()->load($id);
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getMediaUrl()
    {
        $baseurl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $baseurl;
    }

    public function getIp()
    {
        return $this->remoteAddress->getRemoteAddress();
    }
}
