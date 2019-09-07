<?php

namespace Ced\Directory\Block\Adminhtml\Employee\Index;

use Ced\Directory\Helper\Data as CedHelper;
use Ced\Directory\Model\ResourceModel\Collection\CollectionFactory as DirectoryCollection;
use Exception;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Ced\Directory\Model\System\Config\Status as ConfigStatus;

class Grid extends Extended
{
    /**
     * @var \Ced\Directory\Helper\Data
     * @var \Ced\Directory\Model\System\Config\Status
     */
    protected $cedHelper;
    protected $configStatus;
    protected $directoryFactory;

    /**
     * @param Data $country
     * @param Context $context
     * @param Data $backendHelper
     * @param DirectoryCollection $directoryFactory
     * @param array $data
     */

    public function __construct(
        CedHelper $cedHelper,
        ConfigStatus $configStatus,
        Context $context,
        Data $backendHelper,
        DirectoryCollection $directoryFactory,
        array $data = []
    ) {
        $this->cedHelper = $cedHelper;
        $this->configStatus = $configStatus;
        $this->directoryFactory = $directoryFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _prepareCollection()
    {
        $directory = $this->directoryFactory->create();
        $this->setCollection($directory);
        return parent::_prepareCollection();
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('directory/employee/delete'),
                'confirm' => __('Are you sure?')
            ]
        );
        $this->getMassactionBlock()->addItem(
            'changestatus',
            [
                'label' => __('Change Status'),
                'url' => $this->getUrl('directory/employee/changestatus'),
                'confirm' => __('Are you sure?')
            ]
        );
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'type' => 'text',
                'index' => 'name',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'joining_date',
            [
                'header' => __('Joining Date'),
                'index' => 'joining_date',
                'class' => '',
                'width' => '125px',
            ]
        );

        $this->addColumn(
            'country_name',
            [
                'header' => __('Country Name'),
                'index' => 'country_name',
                'type'=> 'options',
                'source' => \Ced\Directory\Helper\Data::class,
                'options' => $this->cedHelper->getCountries(),
                'width' => '125px',
            ]
        );

        $this->addColumn(
            'gender',
            [
                'header' => __('Gender'),
                'index' => 'gender',
                'width' => '125px',
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type'=> 'options',
                'source' => \Ced\Directory\Model\System\Config\Status::class,
                'options' => $this->configStatus->toAllOptionArray(),
                'width' => '125px',
            ]
        );

        $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'width' => '100px',
                'type' => 'action',
                'renderer'  => \Ced\Directory\Block\Adminhtml\Employee\Index\Grid\Renderer\Action::class,
                /*'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => $this->getUrl('directory/employee/edit'),
                        'field' => 'id'   // pass id as parameter
                    ]
                ],
                'filter' => false,
                'sortable' => false,*/
                'index' => 'id',
                'is_system' => true
            ]
        );
        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('directory/employee/edit', ['_current' => true]);
    }
}
