<?php

namespace Ced\Brand\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Ced\Brand\Model\DeletedBrandFactory;

class BrandDeleteObserver implements ObserverInterface
{

    protected $deletedBrandModel;

    public function __construct(
        DeletedBrandFactory $deletedBrandModel
    ) {
        $this->deletedBrandModel = $deletedBrandModel;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $model = $observer->getBrand()->getData();
        $deletedBrandModel = $this->deletedBrandModel->create();
        $deletedBrandModel->setBrandId($model['brand_id']);
        $deletedBrandModel->setStatus($model['status']);
        $deletedBrandModel->setName($model['name']);
        $deletedBrandModel->setCreatedAt($model['created_at']);
        $deletedBrandModel->setModifiedAt($model['modified_at']);
        $deletedBrandModel->setImage($model['image']);
        $deletedBrandModel->setDescription($model['description']);
        $deletedBrandModel->save();
    }
}
