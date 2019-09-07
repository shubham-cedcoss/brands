<?php

namespace Ced\Brand\Controller\Adminhtml\Brand;

use Ced\Brand\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Form
 * @package Ced\Brand\Controller\Adminhtml\Brand
 */
class Form extends Action
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
     * Form constructor.
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
            $resultPage->getConfig()->getTitle()->prepend(__('Form'));
            return $resultPage;
        }
        $resultRedirect = $this->resultRedirectFactory->create()->setPath('admin/dashboard/index');
        return $resultRedirect;
    }
}
