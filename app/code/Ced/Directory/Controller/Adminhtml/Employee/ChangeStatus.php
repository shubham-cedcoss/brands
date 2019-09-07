<?php
namespace Ced\Directory\Controller\Adminhtml\Employee;

use Magento\Framework\App\Action\Context;

class ChangeStatus extends \Magento\Framework\App\Action\Action
{
    protected $directory;

    public function __construct(
        Context $context,
        \Ced\Directory\Model\DirectoryFactory $directory
    ) {
        $this->directory = $directory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $id = explode(',', $id);
        if ($id) {
            $counter = 0;
            foreach ($id as $idValue) {
                try {
                    $directoryModel = $this->directory->create();
                    $row = $directoryModel->load($idValue);
                    $status = $row->getStatus();
                    $row->setStatus(!$status);/*print_r($row->getData());die;*/
                    $row->save();
                    $counter++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            try {
                if ($counter > 0) {
                    $this->messageManager->addSuccessMessage(__('Status of %1 records Successfully Changed', $counter));
                } /*else {
                    $this->messageManager->addErrorMessage(__('Data not Changed.'));
                }*/
            } catch (\Exception $e) {
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('directory/employee/index');
        return $resultRedirect;
    }
}
