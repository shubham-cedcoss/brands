<?php

namespace Ced\FileExtending\Block\Product;

class view extends \Magento\Catalog\Block\Product\View
{
    public function getAddToCartUrl($product, $additional = [])
    {
        return parent::getAddToCartUrl($product, $additional);
    }
}
