<?php
/**
 * RequestDesk Sync Index Block
 *
 * Admin block for product sync page.
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Block\Adminhtml\Sync;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Template
{
    private const XML_PATH_API_KEY = 'requestdesk_blog/api/api_key';
    private const XML_PATH_ENDPOINT_URL = 'requestdesk_blog/api/endpoint_url';

    /**
     * @var ProductCollectionFactory
     */
    private ProductCollectionFactory $productCollectionFactory;

    /**
     * @param Context $context
     * @param ProductCollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ProductCollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * Get sync products URL
     *
     * @return string
     */
    public function getSyncUrl(): string
    {
        return $this->getUrl('requestdesk_blog/sync/products');
    }

    /**
     * Get test connection URL
     *
     * @return string
     */
    public function getTestUrl(): string
    {
        return $this->getUrl('requestdesk_blog/sync/test');
    }

    /**
     * Get configuration URL
     *
     * @return string
     */
    public function getConfigUrl(): string
    {
        return $this->getUrl('adminhtml/system_config/edit', ['section' => 'requestdesk_blog']);
    }

    /**
     * Get total product count
     *
     * @return int
     */
    public function getTotalProductCount(): int
    {
        $collection = $this->productCollectionFactory->create();
        $collection
            ->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
            ->addAttributeToFilter('visibility', ['neq' => \Magento\Catalog\Model\Product\Visibility::VISIBILITY_NOT_VISIBLE]);

        return $collection->getSize();
    }

    /**
     * Check if API is configured
     *
     * @return bool
     */
    public function isApiConfigured(): bool
    {
        $apiKey = $this->_scopeConfig->getValue(
            self::XML_PATH_API_KEY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        return !empty($apiKey);
    }

    /**
     * Get configured endpoint URL
     *
     * @return string
     */
    public function getEndpointUrl(): string
    {
        $url = $this->_scopeConfig->getValue(
            self::XML_PATH_ENDPOINT_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        return $url ?: 'https://app.requestdesk.ai';
    }
}
