<?php
namespace Ced\Directory\Controller\Adminhtml\Employee;

use Magento\Framework\App\Action\Context;

class Delete extends \Magento\Framework\App\Action\Action
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
        $directoryModel = $this->directory->create();
        $counter = 0;
        foreach ($id as $idValue) {
            try {
                $directoryModel->load($idValue)->delete();
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //$error[] = $e->getMessage();
                //array_push($error, $e->getMessage());
            }
        }
        try {
            if ($counter > 0) {
                $this->messageManager->addSuccessMessage(__('%1 Records Successfully deleted', $counter));
            } /*else {
                $this->messageManager->addErrorMessage($error);
            }*/
        } catch (\Exception $e) {
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('directory/employee/index');
        return $resultRedirect;
    }
}
