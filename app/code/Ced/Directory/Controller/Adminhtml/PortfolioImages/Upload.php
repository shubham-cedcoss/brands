<?php

namespace Ced\Directory\Controller\Adminhtml\PortfolioImages;

use Ced\Directory\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 * @package Ced\Directory\Controller\Adminhtml\PortfolioImages
 */
class Upload extends Action
{

    /**
     * @var ImageUploader
     */
    public $imageUploader;

    /**
     * Upload constructor.
     * @param Action\Context $context
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ced_Directory::directory');
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return void
     */
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('image');
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
