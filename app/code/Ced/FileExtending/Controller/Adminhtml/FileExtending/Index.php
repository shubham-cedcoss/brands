<?php

namespace Ced\FileExtending\Controller\Adminhtml\FileExtending;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Ced\FilesExtending\Controller\Adminhtml\Extending
 */
class Index extends \Magento\Catalog\Controller\Adminhtml\Product\Index
{

    /**
     * @return Page
     */
    public function execute()
    {
        //$this->messageManager->addSuccess('Message from new controller.');
        return parent::execute();
    }
}
