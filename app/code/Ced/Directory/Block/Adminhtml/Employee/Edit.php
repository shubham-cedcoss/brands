<?php
namespace Ced\Directory\Block\Adminhtml\Employee;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_blockGroup = 'Ced_Directory';
        $this->_controller = 'adminhtml_employee';
        parent::_construct();

        if ($this->_isAllowedAction('Ced_Directory::employee_save')) {
            $this->buttonList->update('save', 'label', __('Save Details'));
        } else {
            $this->buttonList->remove('save');
        }
    }
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
