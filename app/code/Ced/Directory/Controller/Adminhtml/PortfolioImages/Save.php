<?php

namespace Ced\Directory\Controller\Adminhtml\PortfolioImages;

use Ced\Directory\Model\PortfolioImagesFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 * @package Ced\Directory\Controller\Adminhtml\PortfolioImages
 */
class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var PortfolioImagesFactory
     */
    protected $portfolioImages;

    /**
     * Save constructor.
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param PortfolioImagesFactory $portfolioImages
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        PortfolioImagesFactory $portfolioImages
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->portfolioImages = $portfolioImages;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $data = $this->filterImageData($data);
        $portfolioModel = $this->portfolioImages->create();
        $portfolioModel->setData($data);
        try {
            if ($portfolioModel->save()) {
                $this->messageManager->addSuccessMessage(__('You saved the data.'));
            } else {
                $this->messageManager->addErrorMessage(__('Data was not saved.'));
            }
        } catch (\Exception $e) {
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('directory/portfolioimages/index');
        return $resultRedirect;
    }

    /**
     * @param array $rawData
     * @return array
     */
    public function filterImageData(array $rawData)
    {
        //Replace icon with fileuploader field name
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $data['image'] = $data['image'][0]['name'];
        } else {
            $data['image'] = null;
        }
        if (isset($data['store_id'][0])) {
            $data['store_id'] = $data['store_id'][0];
        } else {
            $data['store_id'] = null;
        }
        return $data;
    }
}
