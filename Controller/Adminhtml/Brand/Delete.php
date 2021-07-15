<?php

namespace Ced\Brand\Controller\Adminhtml\Brand;

use Ced\Brand\Helper\Data;
use Ced\Brand\Model\BrandFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Event\Manager;

/**
 * Class Delete
 * @package Ced\Brand\Controller\Adminhtml\Brand
 */
class Delete extends Action
{
    /**
     * @var Manager
     */
    protected $eventManager;
    /**
     * @var BrandFactory
     */
    protected $brandModel;
    /**
     * @var Data
     */
    protected $helperData;
    /**
     * @var ResultInterface
     */

    /**
     * Delete constructor.
     * @param Context $context
     * @param ResultInterface $result
     * @param Manager $eventManager
     * @param BrandFactory $brandModel
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Manager $eventManager,
        BrandFactory $brandModel,
        Data $helperData
    ) {
        $this->brandModel = $brandModel;
        $this->eventManager = $eventManager;
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enabled')) {
            $brand_id = $this->getRequest()->getParam('brand_id');
            $brandModel = $this->brandModel->create()->load($brand_id);
            $this->eventManager->dispatch('custom_brand_delete_after', ['brand' => $brandModel]);
            try {
                if ($brandModel->delete()) {
                    $this->messageManager->addSuccessMessage(__('You deleted brand.'));
                } else {
                    $this->messageManager->addErrorMessage(__('brand was not deleted.'));
                }
            } catch (\Exception $e) {
            }
            $resultRedirect = $this->resultRedirectFactory->create()->setPath('brand/brand/index');
            return $resultRedirect;
        }
        $resultRedirect = $this->resultRedirectFactory->create()->setPath('admin/dashboard/index');
        return $resultRedirect;
    }
}
