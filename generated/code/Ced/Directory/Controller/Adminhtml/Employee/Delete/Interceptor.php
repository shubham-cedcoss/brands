<?php
namespace Ced\Directory\Controller\Adminhtml\Employee\Delete;

/**
 * Interceptor class for @see \Ced\Directory\Controller\Adminhtml\Employee\Delete
 */
class Interceptor extends \Ced\Directory\Controller\Adminhtml\Employee\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ced\Directory\Model\DirectoryFactory $directory)
    {
        $this->___init();
        parent::__construct($context, $directory);
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
