<?php
/**
 * RequestDesk Blog Post Collection
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use RequestDesk\Blog\Model\Post;
use RequestDesk\Blog\Model\ResourceModel\Post as PostResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'requestdesk_blog_post_collection';

    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(Post::class, PostResource::class);
    }

    /**
     * Add store filter
     *
     * @param int $storeId
     * @return $this
     */
    public function addStoreFilter(int $storeId): self
    {
        $this->addFieldToFilter('store_id', ['in' => [0, $storeId]]);
        return $this;
    }

    /**
     * Add published filter
     *
     * @return $this
     */
    public function addPublishedFilter(): self
    {
        $this->addFieldToFilter('status', 1);
        return $this;
    }
}
