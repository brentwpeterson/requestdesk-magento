<?php
/**
 * Copyright (c) 2025 Content Basis LLC
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/licenses/OSL-3.0
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 * @author    Content Basis LLC
 * @copyright Copyright (c) 2025 Content Basis LLC
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License 3.0
 */
declare(strict_types=1);

namespace RequestDesk\Blog\Block\Adminhtml\Import;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use RequestDesk\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class Index extends Template
{
    private const XML_PATH_API_KEY = 'requestdesk_blog/api/api_key';
    private const XML_PATH_ENDPOINT_URL = 'requestdesk_blog/api/endpoint_url';

    /**
     * @var PostCollectionFactory
     */
    private PostCollectionFactory $postCollectionFactory;

    /**
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * Get import posts URL
     *
     * @return string
     */
    public function getImportUrl(): string
    {
        return $this->getUrl('requestdesk_blog/import/posts');
    }

    /**
     * Get test connection URL
     *
     * @return string
     */
    public function getTestUrl(): string
    {
        return $this->getUrl('requestdesk_blog/import/testconnection');
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
     * Get posts list URL
     *
     * @return string
     */
    public function getPostsListUrl(): string
    {
        return $this->getUrl('requestdesk_blog/post/index');
    }

    /**
     * Get total imported post count
     *
     * @return int
     */
    public function getImportedPostCount(): int
    {
        $collection = $this->postCollectionFactory->create();
        $collection->addFieldToFilter('requestdesk_post_id', ['notnull' => true]);

        return $collection->getSize();
    }

    /**
     * Get total local post count
     *
     * @return int
     */
    public function getTotalPostCount(): int
    {
        $collection = $this->postCollectionFactory->create();
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
