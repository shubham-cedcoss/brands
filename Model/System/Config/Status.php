<?php

namespace Ced\Brand\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Status
 * @package Ced\Brand\Model\System\Config
 */
class Status implements ArrayInterface
{
    /**
     *
     */
    const ENABLED  = 1;
    /**
     *
     */
    const DISABLED = 0;

    /**
     * @return array
     */
    public function toAllOptionArray()
    {
        $options = [
            self::ENABLED => __('Enabled'),
            self::DISABLED => __('Disabled')
        ];

        return $options;
    }

    /**
     * @param bool $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = false)
    {
        $options = [
            [
                'value' => self::ENABLED,
                'label' => __('Enable')
            ],
            [
                'value' => self::DISABLED,
                'label' => __('Disable')
            ]
        ];
        return $options;
    }
}
