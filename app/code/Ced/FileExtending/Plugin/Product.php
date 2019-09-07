<?php

namespace Ced\FileExtending\Plugin;

class Product
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $result = $result + (($result * 10) / 100);
        return $result;
    }
}
