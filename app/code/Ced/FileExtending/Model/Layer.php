<?php

namespace Ced\FileExtending\Model;

class Layer extends \Magento\Catalog\Model\Layer
{
    public function getProductCollection()
    {
       // die("dieeee");
        return parent::getProductCollection();
    }
}
