<?php
/**
 * RequestDesk Blog Post IsActive Source
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */
declare(strict_types=1);

namespace RequestDesk\Blog\Model\Post\Source;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{
    /**
     * Status values
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::STATUS_ENABLED, 'label' => __('Published')],
            ['value' => self::STATUS_DISABLED, 'label' => __('Draft')]
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
            self::STATUS_DISABLED => __('Draft'),
            self::STATUS_ENABLED => __('Published')
        ];
    }
}
