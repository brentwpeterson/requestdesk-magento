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
