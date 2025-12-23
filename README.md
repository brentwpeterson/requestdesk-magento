# RequestDesk Blog Extension for Magento 2

Native blog functionality with direct RequestDesk API integration.

## Overview

This extension provides complete blog functionality for Magento 2 stores, with bidirectional sync to RequestDesk. Unlike other platforms (Shopify), Magento has no built-in blog - this module fills that gap while integrating directly with RequestDesk's content generation system.

## Requirements

- Magento 2.4.7 or later
- PHP 8.1 or later

## Features

- **Full Blog System**: Posts, categories, SEO metadata
- **Product Linking**: Critical Magento feature - link products to blog posts
- **RequestDesk Sync**: Bidirectional sync with RequestDesk
- **REST API**: Complete API for headless/PWA implementations
- **Store Scoping**: Multi-store support
- **Minimal Admin UI**: Configuration only - manage content via RequestDesk

## Installation

### Via Composer (Recommended)

```bash
composer require requestdesk/module-blog
bin/magento module:enable RequestDesk_Blog
bin/magento setup:upgrade
bin/magento cache:clean
```

### Manual Installation

1. Copy to `app/code/RequestDesk/Blog/`
2. Run:
```bash
bin/magento module:enable RequestDesk_Blog
bin/magento setup:upgrade
bin/magento cache:clean
```

## Configuration

Navigate to **Stores > Configuration > RequestDesk > Blog**

- **General**: Enable/disable, posts per page
- **API**: RequestDesk API key and endpoint
- **SEO**: URL prefix, default meta tags

## REST API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/V1/requestdesk/blog/posts` | Create/update post |
| GET | `/V1/requestdesk/blog/posts` | List posts |
| GET | `/V1/requestdesk/blog/posts/:id` | Get single post |
| DELETE | `/V1/requestdesk/blog/posts/:id` | Delete post |
| POST | `/V1/requestdesk/blog/posts/:id/products` | Link products |
| GET | `/V1/requestdesk/blog/posts/:id/products` | Get linked products |
| GET | `/V1/requestdesk/blog/products/:id/posts` | Get posts for product |

## Database Tables

- `requestdesk_blog_post` - Blog posts with sync fields
- `requestdesk_blog_category` - Blog categories
- `requestdesk_blog_post_category` - Post/category links
- `requestdesk_blog_product` - Product/post links (critical for Magento)

## Frontend Routes

- `/blog` - Blog listing
- `/blog/category/{url_key}` - Category listing
- `/blog/{url_key}` - Single post

## Development

### Testing with Docker

Use the base-magento Docker environment in cb-magento-integration:

```bash
cd ../base-magento
bin/start
```

### Symlink for Development

```bash
ln -s /path/to/requestdesk-blog src/app/code/RequestDesk/Blog
bin/magento setup:upgrade
```

## License

Proprietary - RequestDesk
