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

namespace RequestDesk\Blog\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use RequestDesk\Blog\Api\Data\PostInterface;
use RequestDesk\Blog\Api\Data\PostSearchResultsInterface;
use RequestDesk\Blog\Api\Data\PostSearchResultsInterfaceFactory;
use RequestDesk\Blog\Api\PostRepositoryInterface;
use RequestDesk\Blog\Model\ResourceModel\Post as PostResource;
use RequestDesk\Blog\Model\ResourceModel\Post\CollectionFactory;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @param PostResource $resource
     * @param PostFactory $postFactory
     * @param CollectionFactory $collectionFactory
     * @param PostSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        private readonly PostResource $resource,
        private readonly PostFactory $postFactory,
        private readonly CollectionFactory $collectionFactory,
        private readonly PostSearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor
    ) {
    }

    /**
     * @inheritdoc
     */
    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save the blog post: %1', $e->getMessage()),
                $e
            );
        }
        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $postId): PostInterface
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);

        if (!$post->getPostId()) {
            throw new NoSuchEntityException(__('Blog post with ID "%1" does not exist.', $postId));
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getByUrlKey(string $urlKey, int $storeId = 0): PostInterface
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('url_key', $urlKey);

        if ($storeId > 0) {
            $collection->addFieldToFilter('store_id', ['in' => [0, $storeId]]);
        }

        $post = $collection->getFirstItem();

        if (!$post->getPostId()) {
            throw new NoSuchEntityException(__('Blog post with URL key "%1" does not exist.', $urlKey));
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getByRequestdeskPostId(string $requestdeskPostId): PostInterface
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('requestdesk_post_id', $requestdeskPostId);

        $post = $collection->getFirstItem();

        if (!$post->getPostId()) {
            throw new NoSuchEntityException(
                __('Blog post with RequestDesk ID "%1" does not exist.', $requestdeskPostId)
            );
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PostSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function delete(PostInterface $post): bool
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __('Could not delete the blog post: %1', $e->getMessage()),
                $e
            );
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $postId): bool
    {
        return $this->delete($this->getById($postId));
    }
}
