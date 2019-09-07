<?php
namespace Ced\Directory\Controller\Adminhtml\EmployeeUI;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Ced\Directory\Controller\Adminhtml\EmployeeUI
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_Directory::directory');
        $resultPage->addBreadcrumb(__('Directory'), __('Directory'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Employee'));
        return $resultPage;
    }
}
