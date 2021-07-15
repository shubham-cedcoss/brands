<?php

namespace Ced\Brand\Controller\Adminhtml\Brand;

use Ced\Brand\Helper\Data;
use Ced\Brand\Model\BrandFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 * @package Ced\Brand\Controller\Adminhtml\Brand
 */
class Save extends Action
{
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
     * Save constructor.
     * @param Context $context
     * @param BrandFactory $brandModel
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        BrandFactory $brandModel,
        Data $helperData
    ) {
        $this->brandModel = $brandModel;
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enabled')) {
            $data = $this->getRequest()->getParams();
            $data = $this->filterData($data);
            $brandModel = $this->brandModel->create();
            $brandModel->setData($data);
            try {
                if ($brandModel->save()) {
                    $this->messageManager->addSuccessMessage(__('You saved the data.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Data was not saved.'));
                }
            } catch (\Exception $e) {
            }
            $resultRedirect = $this->resultRedirectFactory->create()->setPath('brand/brand/index');
            return $resultRedirect;
        }
        $resultRedirect = $this->resultRedirectFactory->create()->setPath('admin/dashboard/index');
        return $resultRedirect;
    }

    /**
     * @param array $rawData
     * @return array
     */
    public function filterData(array $rawData)
    {
        $data = $rawData;
        $data['image'] = isset($data['brand_form_fieldset2']['image'][0]['name']) ? $data['image'] = $data['brand_form_fieldset2']['image'][0]['name'] : null;
        $data['name'] = isset($data['brand_form_fieldset']['name']) ? $data['brand_form_fieldset']['name'] : null;
        $data['status'] = isset($data['brand_form_fieldset']['status']) ? $data['brand_form_fieldset']['status'] : null;
        $data['description'] = isset($data['brand_form_fieldset']['description']) ? $data['brand_form_fieldset']['description'] : null;
        unset($data['brand_form_fieldset']);
        unset($data['brand_form_fieldset2']);
        return $data;
    }
}
