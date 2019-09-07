<?php

namespace Ced\Directory\Ui\DataProvider;

use Ced\Directory\Model\ResourceModel\PortfolioImages\Collection;
use Ced\Directory\Model\ResourceModel\PortfolioImages\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 * @package Ced\Directory\Ui\DataProvider
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
     * @param CollectionFactory $portfolioImagesCollection
     * @param StoreManagerInterface $storeManager
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $portfolioImagesCollection,
        StoreManagerInterface $storeManager,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $portfolioImagesCollection->create();
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
        $baseurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getImage()) {
                $img['image'][0]['name'] = $model->getImage();
                $img['image'][0]['url'] = $baseurl . 'directory/' . 'tmp/' . 'images/' . $model->getImage();
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $img);
            }
        }

        return $this->loadedData;
    }
}
