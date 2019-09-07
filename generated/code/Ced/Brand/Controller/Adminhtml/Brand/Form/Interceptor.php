<?php
namespace Ced\Brand\Controller\Adminhtml\Brand\Form;

/**
 * Interceptor class for @see \Ced\Brand\Controller\Adminhtml\Brand\Form
 */
class Interceptor extends \Ced\Brand\Controller\Adminhtml\Brand\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Ced\Brand\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $helperData);
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
