<?php
namespace Ced\Brand\Controller\Adminhtml\Brand\Delete;

/**
 * Interceptor class for @see \Ced\Brand\Controller\Adminhtml\Brand\Delete
 */
class Interceptor extends \Ced\Brand\Controller\Adminhtml\Brand\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Event\Manager $eventManager, \Ced\Brand\Model\BrandFactory $brandModel, \Ced\Brand\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $eventManager, $brandModel, $helperData);
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
