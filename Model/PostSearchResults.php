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

use Magento\Framework\Api\SearchResults;
use RequestDesk\Blog\Api\Data\PostSearchResultsInterface;

class PostSearchResults extends SearchResults implements PostSearchResultsInterface
{
    /**
     * Get posts list
     *
     * @return \RequestDesk\Blog\Api\Data\PostInterface[]
     */
    public function getItems(): array
    {
        return parent::getItems() ?? [];
    }

    /**
     * Set posts list
     *
     * @param \RequestDesk\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items): self
    {
        parent::setItems($items);
        return $this;
    }
}
