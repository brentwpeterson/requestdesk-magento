<?php
/**
 * RequestDesk Blog Post Resource Model
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'requestdesk_blog_post_resource';

    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init('requestdesk_blog_post', 'post_id');
    }
}
