<?php
namespace Ced\Directory\Controller\Adminhtml\PortfolioImages\Save;

/**
 * Interceptor class for @see \Ced\Directory\Controller\Adminhtml\PortfolioImages\Save
 */
class Interceptor extends \Ced\Directory\Controller\Adminhtml\PortfolioImages\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Ced\Directory\Model\PortfolioImagesFactory $portfolioImages)
    {
        $this->___init();
        parent::__construct($context, $dataPersistor, $portfolioImages);
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
