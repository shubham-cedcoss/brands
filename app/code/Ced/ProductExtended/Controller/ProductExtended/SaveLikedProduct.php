<?php

namespace Ced\ProductExtended\Controller\ProductExtended;

use Ced\ProductExtended\Model\LikedProductFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class SaveLikedProduct
 * @package Ced\ProductExtended\Controller\ProductExtended
 */
class SaveLikedProduct extends Action
{
    /**
     * @var LikedProductFactory
     */
    protected $modelFactory;

    /**
     * SaveLikedProduct constructor.
     * @param Context $context
     * @param LikedProductFactory $modelFactory
     */
    public function __construct(
        Context $context,
        LikedProductFactory $modelFactory
    ) {
        $this->modelFactory = $modelFactory;
        parent::__construct($context);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $model = $this->modelFactory->create()->setData($post);
        $action = $post['action'];
        $data = $model->getCollection()->addFieldToFilter('product_id', $post['product_id'])->getData();
        $remoteIP = array_column($data, 'remote_ip', 'id');
        switch ($action) {
            case 'like':
                if ($model->save()) {
                    print_r(json_encode("liked"));
                    exit;
                }
                break;

            case 'validate':
                if (in_array($post['remote_ip'], $remoteIP)) {
                    print_r(json_encode('validated'));
                    exit;
                }
                break;

            case 'unlike':
                $id = array_search($post['remote_ip'], $remoteIP);
                if ($model->load($id)->delete()) {
                    print_r(json_encode('unliked'));
                    exit;
                }
                break;

            default:
                break;
        }
    }
}
