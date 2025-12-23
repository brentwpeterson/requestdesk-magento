<?php
/**
 * RequestDesk Blog Extension for Magento 2
 *
 * Provides blog functionality with direct RequestDesk API integration.
 * Enables bidirectional blog post sync between Magento and RequestDesk.
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'RequestDesk_Blog',
    __DIR__
);
