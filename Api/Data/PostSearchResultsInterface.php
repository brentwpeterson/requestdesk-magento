<?php
/**
 * RequestDesk Blog Post Search Results Interface
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get posts list
     *
     * @return \RequestDesk\Blog\Api\Data\PostInterface[]
     */
    public function getItems(): array;

    /**
     * Set posts list
     *
     * @param \RequestDesk\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items): self;
}
