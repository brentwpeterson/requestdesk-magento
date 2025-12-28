<?php
/**
 * RequestDesk Data Export API Interface
 *
 * Exposes Magento data (products, categories, CMS pages) to RequestDesk
 * for syncing to the knowledge base. Authenticated via X-RequestDesk-Key header.
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
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
