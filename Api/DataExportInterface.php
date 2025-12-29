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

interface DataExportInterface
{
    /**
     * Test connection and validate API key
     *
     * @return mixed[] Connection status with store info
     */
    public function testConnection(): array;

    /**
     * Get products for export to RequestDesk
     *
     * @param int $pageSize Number of products per page (default 100)
     * @param int $currentPage Page number (1-indexed)
     * @return mixed[] Products data in RequestDesk format
     */
    public function getProducts(int $pageSize = 100, int $currentPage = 1): array;

    /**
     * Get categories for export to RequestDesk
     *
     * @return mixed[] Categories data in RequestDesk format
     */
    public function getCategories(): array;

    /**
     * Get CMS pages for export to RequestDesk
     *
     * @param int $pageSize Number of pages per request (default 100)
     * @param int $currentPage Page number (1-indexed)
     * @return mixed[] CMS pages data in RequestDesk format
     */
    public function getCmsPages(int $pageSize = 100, int $currentPage = 1): array;
}
