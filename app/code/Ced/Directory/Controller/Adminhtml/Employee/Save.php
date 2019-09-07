<?php
namespace Ced\Directory\Controller\Adminhtml\Employee;

use Ced\Directory\Model\DirectoryFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 * @package Ced\Directory\Controller\Adminhtml\Employee
 */
class Save extends Action
{
    /**
     * @var DirectoryFactory
     */
    protected $directory;

    /**
     * Save constructor.
     * @param Context $context
     * @param DirectoryFactory $directory
     */
    public function __construct(
        Context $context,
        DirectoryFactory $directory
    ) {
        $this->directory = $directory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $id = isset($data['id']) ? $data['id'] : 0;
        $directoryModel = $this->directory->create();
        if ($id) {
            $directoryModel->load($id);
        }
        $directoryModel->setData($data);
        try {
            if ($directoryModel->save()) {
                $this->messageManager->addSuccessMessage(__('You saved the data.'));
            } else {
                $this->messageManager->addErrorMessage(__('Data was not saved.'));
            }
        } catch (\Exception $e) {
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('directory/employee/index');
        return $resultRedirect;
    }
}
