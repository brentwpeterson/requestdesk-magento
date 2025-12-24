<?php
/**
 * RequestDesk Blog Post SyncStatus Source
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */
declare(strict_types=1);

namespace RequestDesk\Blog\Model\Post\Source;

use Magento\Framework\Data\OptionSourceInterface;

class SyncStatus implements OptionSourceInterface
{
    /**
     * Sync status values
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SYNCED = 'synced';
    const STATUS_FAILED = 'failed';
    const STATUS_NOT_SYNCED = 'not_synced';

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::STATUS_SYNCED, 'label' => __('Synced')],
            ['value' => self::STATUS_PENDING, 'label' => __('Pending')],
            ['value' => self::STATUS_FAILED, 'label' => __('Failed')],
            ['value' => self::STATUS_NOT_SYNCED, 'label' => __('Not Synced')]
        ];
    }

    /**
     * Get options as key-value pairs
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::STATUS_SYNCED => __('Synced'),
            self::STATUS_PENDING => __('Pending'),
            self::STATUS_FAILED => __('Failed'),
            self::STATUS_NOT_SYNCED => __('Not Synced')
        ];
    }
}
