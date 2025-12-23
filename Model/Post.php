<?php
/**
 * RequestDesk Blog Post Model
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use RequestDesk\Blog\Api\Data\PostInterface;
use RequestDesk\Blog\Model\ResourceModel\Post as PostResource;

class Post extends AbstractModel implements PostInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'requestdesk_blog_post';

    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(PostResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getPostId(): ?int
    {
        $id = $this->getData(self::POST_ID);
        return $id !== null ? (int) $id : null;
    }

    /**
     * @inheritdoc
     */
    public function setPostId(int $postId): PostInterface
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritdoc
     */
    public function setTitle(string $title): PostInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritdoc
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritdoc
     */
    public function setContent(?string $content): PostInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritdoc
     */
    public function getUrlKey(): ?string
    {
        return $this->getData(self::URL_KEY);
    }

    /**
     * @inheritdoc
     */
    public function setUrlKey(string $urlKey): PostInterface
    {
        return $this->setData(self::URL_KEY, $urlKey);
    }

    /**
     * @inheritdoc
     */
    public function getMetaTitle(): ?string
    {
        return $this->getData(self::META_TITLE);
    }

    /**
     * @inheritdoc
     */
    public function setMetaTitle(?string $metaTitle): PostInterface
    {
        return $this->setData(self::META_TITLE, $metaTitle);
    }

    /**
     * @inheritdoc
     */
    public function getMetaDescription(): ?string
    {
        return $this->getData(self::META_DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    public function setMetaDescription(?string $metaDescription): PostInterface
    {
        return $this->setData(self::META_DESCRIPTION, $metaDescription);
    }

    /**
     * @inheritdoc
     */
    public function getFeaturedImage(): ?string
    {
        return $this->getData(self::FEATURED_IMAGE);
    }

    /**
     * @inheritdoc
     */
    public function setFeaturedImage(?string $featuredImage): PostInterface
    {
        return $this->setData(self::FEATURED_IMAGE, $featuredImage);
    }

    /**
     * @inheritdoc
     */
    public function getStatus(): int
    {
        return (int) $this->getData(self::STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setStatus(int $status): PostInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritdoc
     */
    public function getAuthor(): ?string
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * @inheritdoc
     */
    public function setAuthor(?string $author): PostInterface
    {
        return $this->setData(self::AUTHOR, $author);
    }

    /**
     * @inheritdoc
     */
    public function getStoreId(): int
    {
        return (int) $this->getData(self::STORE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setStoreId(int $storeId): PostInterface
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheritdoc
     */
    public function getRequestdeskPostId(): ?string
    {
        return $this->getData(self::REQUESTDESK_POST_ID);
    }

    /**
     * @inheritdoc
     */
    public function setRequestdeskPostId(?string $requestdeskPostId): PostInterface
    {
        return $this->setData(self::REQUESTDESK_POST_ID, $requestdeskPostId);
    }

    /**
     * @inheritdoc
     */
    public function getRequestdeskSyncStatus(): ?string
    {
        return $this->getData(self::REQUESTDESK_SYNC_STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setRequestdeskSyncStatus(?string $syncStatus): PostInterface
    {
        return $this->setData(self::REQUESTDESK_SYNC_STATUS, $syncStatus);
    }

    /**
     * @inheritdoc
     */
    public function getRequestdeskLastSync(): ?string
    {
        return $this->getData(self::REQUESTDESK_LAST_SYNC);
    }

    /**
     * @inheritdoc
     */
    public function setRequestdeskLastSync(?string $lastSync): PostInterface
    {
        return $this->setData(self::REQUESTDESK_LAST_SYNC, $lastSync);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }
}
