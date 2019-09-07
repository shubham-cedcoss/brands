<?php

namespace Ced\Directory\Block\Adminhtml\Employee\Index\Grid\Renderer;

class Action extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action
{
    /**
     * Renderer for "Action" column in Newsletter templates grid
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $actions[] = [
            'url' => $this->getUrl('*/*/edit', ['id' => $row->getId()]),
            //'popup' => true,
            'target' => '_blank',
            'caption' => __('Edit'),
        ];

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
}
