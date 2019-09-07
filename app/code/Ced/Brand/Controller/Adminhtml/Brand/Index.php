<?php

namespace Ced\Brand\Controller\Adminhtml\Brand;

use Ced\Brand\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Ced\Brand\Controller\adminhtml\Brand
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Data $helperData
    ) {
        parent::__construct($context);
        $this->helperData = $helperData;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enabled')) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('Ced_Brand::brand');
            $resultPage->addBreadcrumb(__('Brand'), __('Brand'));
            $resultPage->getConfig()->getTitle()->prepend(__('Brand Listing'));
            return $resultPage;
        }

        $resultRedirect = $this->resultRedirectFactory->create()->setPath('admin/dashboard/index');
        return $resultRedirect;
    }
}
