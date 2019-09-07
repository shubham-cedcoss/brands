<?php

namespace Ced\Brand\Block\Adminhtml\Brand\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Block\Adminhtml\Block\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Ced\Brand\Block\Adminhtml\Brand\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    protected $context;

    public function __construct(
        Context $context,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->context = $context;
        parent::__construct($context, $blockRepository);
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $brand_id['brand_id'] = $this->context->getRequest()->getParam('brand_id');
        return [
            'label' => __('Delete'),
            'class' => 'delete primary',
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('brand/brand/delete', $brand_id)),
            'sort_order' => 90,
        ];
    }
}
