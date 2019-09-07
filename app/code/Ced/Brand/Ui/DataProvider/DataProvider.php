<?php

namespace Ced\Brand\Ui\DataProvider;

use Ced\Brand\Model\ResourceModel\Brand\Collection;
use Ced\Brand\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 * @package Ced\Brand\Ui\DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $primaryFieldName;
    /**
     * @var
     */
    protected $requestFieldName;
    /**
     * @var Collection
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var StoreManagerInterface
     */
    public $_storeManager;
    /**
     * @var
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $brandCollection
     * @param StoreManagerInterface $storeManager
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $brandCollection,
        StoreManagerInterface $storeManager,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $brandCollection->create();
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager=$storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData()
    {
        $baseurl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getId()) {
                $preData['brand_form_fieldset']['status'] = $model->getStatus();
                $preData['brand_form_fieldset']['name'] = $model->getName();
                $preData['brand_form_fieldset']['description'] = $model->getDescription();
                $preData['brand_form_fieldset2']['image'][0]['name'] = $model->getImage();
                $preData['brand_form_fieldset2']['image'][0]['url'] = $baseurl . 'brand/' . 'tmp/' . 'images/' . $model->getImage();
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $preData);
                /*echo "<pre>";
                print_r($this->loadedData[$model->getId()]);die;*/
            }
        }

        return $this->loadedData;
    }
}
