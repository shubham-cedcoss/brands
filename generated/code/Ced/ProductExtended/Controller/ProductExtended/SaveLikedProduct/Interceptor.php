<?php
namespace Ced\ProductExtended\Controller\ProductExtended\SaveLikedProduct;

/**
 * Interceptor class for @see \Ced\ProductExtended\Controller\ProductExtended\SaveLikedProduct
 */
class Interceptor extends \Ced\ProductExtended\Controller\ProductExtended\SaveLikedProduct implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ced\ProductExtended\Model\LikedProductFactory $modelFactory)
    {
        $this->___init();
        parent::__construct($context, $modelFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
