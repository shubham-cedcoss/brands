<?php
namespace Ced\Brand\Controller\Adminhtml\Brand\Upload;

/**
 * Interceptor class for @see \Ced\Brand\Controller\Adminhtml\Brand\Upload
 */
class Interceptor extends \Ced\Brand\Controller\Adminhtml\Brand\Upload implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ced\Brand\Model\ImageUploader $imageUploader, \Ced\Brand\Helper\Data $helperData, \Magento\Framework\Controller\ResultInterface $result)
    {
        $this->___init();
        parent::__construct($context, $imageUploader, $helperData, $result);
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
