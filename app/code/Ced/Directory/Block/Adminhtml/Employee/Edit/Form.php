<?php
namespace Ced\Directory\Block\Adminhtml\Employee\Edit;

use Ced\Directory\Model\DirectoryFactory as DirectoryCollection;
use Magento\Backend\Block\Widget\Form\Generic;

/**
 * Class Form
 * @package Ced\Directory\Block\Adminhtml\Employee\Edit
 */
class Form extends Generic
{
    /**
     * @var \Magento\Directory\Model\Config\Source\Country
     */
    protected $country;
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;
    /**
     * @var DirectoryCollection
     */
    protected $directoryFactory;

    /**
     * @param DirectoryCollection $directoryFactory
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Directory\Model\Country $country
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        DirectoryCollection $directoryFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Directory\Model\Country $country,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->directoryFactory = $directoryFactory;
        $this->country = $country;
        $this->request = $request;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('department_form');
        $this->setTitle(__('General Information'));
    }

    /**
     * Prepare form
     *
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $id = $this->request->getParam('id');
        $id = isset($id) ? $id : 0;
        $directory = $this->directoryFactory->create();
        $row = $directory->load($id);
        //print_r($row->getData());
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('directory/employee/save'),
                    'method' => 'post'
                ]
            ]
        );

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($id > 0) {
            $fieldset->addField(
                'id',
                'hidden',
                [
                    'name' => 'id',
                ]
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Employee Name'),
                'title' => __('Employee Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'joining_date',
            'date',
            [
                'name' => 'joining_date',
                'label' => __('Joining Date'),
                'id' => 'joining_date',
                'title' => __('Joining Date'),
                'date_format' => 'yyyy-MM-dd',
                'required' => true
            ]
        );

        $fieldset->addField(
            'country_name',
            'select',
            [
                'name' => 'country_name',
                'label' => __('Choose country'),
                'title' => __('Choose country'),
                'required' => true,
                'values' => $this->country->getCollection()->toOptionArray()
            ]
        );

        $fieldset->addField(
            'gender',
            'radios',
            [
                'label' => __('Gender'),
                'title' => __('Gender'),
                'name' => 'gender',
                'required' => true,
                'values' => [
                    ['value'=>'Male','label'=>'Male'],
                    ['value'=>'Female','label'=>'Female'],
                    ['value'=>'Others','label'=>'Others'],
                ],
            ]
        );

        $fieldset->addField(
            'status',
            'checkboxes',
            [
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => [
                    ['value' => '1','label' => 'Enable'],
                ],
            ]
        );

        $form->setUseContainer(true);
        $form->setValues($row->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
