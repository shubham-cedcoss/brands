<?php

namespace Ced\Directory\Block\Adminhtml\Employee;

use Magento\Backend\Block\Widget\Grid\Container;
use Magento\Framework\Exception\LocalizedException;

class Index extends Container
{
    protected function _prepareLayout()
    {
        try {
            $this->setChild(
                'grid',
                $this->getLayout()->createBlock(
                    'Ced\Directory\Block\Adminhtml\Employee\Index\Grid',
                    'ced.directory.employee.grid'
                )
            );
        } catch (LocalizedException $e) {
        }
        return parent::_prepareLayout();
    }

    protected function _addNewButton()
    {
        $this->addButton(
            'add',
            [
                'label' => $this->getAddButtonLabel(),
                'onclick' => 'setLocation(\'' . $this->getCreateUrl() . '\')',
                'class' => 'add primary'
            ]
        );
    }

    public function getCreateUrl()
    {
        return $this->getUrl('directory/employee/edit');
    }

    public function getAddButtonLabel()
    {
        return __('Add New User');
    }
}
