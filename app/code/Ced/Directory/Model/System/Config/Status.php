<?php
namespace Ced\Directory\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    const ENABLED  = 1;
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
     * Return array of options as value-label pairs
     *
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
        /*echo "<pre>";
        print_r($options);
        die;*/
        return $options;
    }
}
