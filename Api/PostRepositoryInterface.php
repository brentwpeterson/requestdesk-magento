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

namespace RequestDesk\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use RequestDesk\Blog\Api\Data\PostInterface;
use RequestDesk\Blog\Api\Data\PostSearchResultsInterface;

interface PostRepositoryInterface
{
    /**
     * Save post
     *
     * @param PostInterface $post
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * Get post by ID
     *
     * @param int $postId
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $postId): PostInterface;

    /**
     * Get post by URL key
     *
     * @param string $urlKey
     * @param int $storeId
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getByUrlKey(string $urlKey, int $storeId = 0): PostInterface;

    /**
     * Get post by RequestDesk post ID
     *
     * @param string $requestdeskPostId
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getByRequestdeskPostId(string $requestdeskPostId): PostInterface;

    /**
     * Get list of posts
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PostSearchResultsInterface;

    /**
     * Delete post
     *
     * @param PostInterface $post
     * @return bool
     * @throws LocalizedException
     */
    public function delete(PostInterface $post): bool;

    /**
     * Delete post by ID
     *
     * @param int $postId
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $postId): bool;
}
