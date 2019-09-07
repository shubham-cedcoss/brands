<?php

namespace Ced\Brand\Controller\Adminhtml\Brand;

use Ced\Brand\Helper\Data;
use Ced\Brand\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Upload
 * @package Ced\Brand\Controller\adminhtml\Brand
 */
class Upload extends Action
{
    /**
     * @var ImageUploader
     */
    public $imageUploader;
    /**
     * @var Data
     */
    protected $helperData;
    /**
     * @var ResultInterface
     */
    protected $result;

    /**
     * Upload constructor.
     * @param Context $context
     * @param ImageUploader $imageUploader
     * @param Data $helperData
     * @param ResultInterface $result
     */
    public function __construct(
        Context $context,
        ImageUploader $imageUploader,
        Data $helperData,
        ResultInterface $result
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->helperData = $helperData;
        $this->result = $result;
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ced_Brand::brand');
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        if ($this->helperData->getGeneralConfig('enabled')) {
            try {
                $imageId = $this->_request->getParam('param_name', 'brand_form_fieldset2');
                $result = $this->imageUploader->saveFileToTmpDir($imageId);
                $result['cookie'] = [
                    'name' => $this->_getSession()->getName(),
                    'value' => $this->_getSession()->getSessionId(),
                    'lifetime' => $this->_getSession()->getCookieLifetime(),
                    'path' => $this->_getSession()->getCookiePath(),
                    'domain' => $this->_getSession()->getCookieDomain(),
                ];
            } catch (\Exception $e) {
                $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
            }
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
        }
    }
}
