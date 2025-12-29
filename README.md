# RequestDesk Blog Extension for Magento 2

[![Magento 2.4.7+](https://img.shields.io/badge/Magento-2.4.7+-orange.svg)](https://magento.com)
[![PHP 8.1+](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License: OSL-3.0](https://img.shields.io/badge/License-OSL--3.0-green.svg)](https://opensource.org/licenses/OSL-3.0)

A native blog extension for Magento 2 with full [RequestDesk](https://requestdesk.ai) integration. Create AI-powered blog content in RequestDesk and automatically sync it to your Magento store, or sync your product catalog to RequestDesk for AI-assisted content creation.

**[Get Started with RequestDesk for Magento →](https://requestdesk.ai/magento)**

## Why This Extension?

Unlike Shopify or WordPress, **Magento has no built-in blog functionality**. This extension provides:

- **Complete Blog System** - Posts, categories, SEO metadata, and frontend templates
- **Product-to-Post Linking** - A critical Magento feature for e-commerce SEO
- **Bidirectional Sync** - Push products to RequestDesk, pull blog posts back
- **AI Content Integration** - Leverage RequestDesk's AI to generate product-focused blog content
- **Multi-Store Support** - Full store scoping for Magento multi-store setups

## Features

### Blog Management
- Full CRUD for blog posts via admin panel
- Category management with hierarchical support
- SEO fields: meta title, meta description, URL keys
- Featured images and media support
- Draft/Published status workflow
- Store-scoped content

### RequestDesk Integration
- **Product Export**: Sync your Magento product catalog to RequestDesk's knowledge base
- **Post Import**: Pull AI-generated blog posts from RequestDesk
- **Sync Status Tracking**: Monitor which posts are synced, pending, or failed
- **Automated Import**: Hourly cron job for automatic post imports
- **API Key Authentication**: Secure communication via `X-RequestDesk-Key` header

### Product Linking
- Link blog posts to related products
- Display related posts on product pages
- Show related products within blog posts
- Semantic search via RequestDesk RAG for smart product-post matching

### REST API
Complete API for headless/PWA implementations and RequestDesk communication.

### Frontend Templates
- Responsive blog listing page
- Individual post view
- Category filtering
- **Hyvä Theme Support**: Optimized templates for Hyvä-based stores

## Requirements

- Magento Open Source or Adobe Commerce 2.4.7+
- PHP 8.1 or later
- RequestDesk account with API key

## Installation

### Via Composer (Recommended)

```bash
composer require requestdesk/magento-blog
bin/magento module:enable RequestDesk_Blog
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:clean
```

### Manual Installation

1. Create the directory structure:
```bash
mkdir -p app/code/RequestDesk/Blog
```

2. Copy the module files to `app/code/RequestDesk/Blog/`

3. Enable and install:
```bash
bin/magento module:enable RequestDesk_Blog
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:clean
```

### Verify Installation

```bash
bin/magento module:status RequestDesk_Blog
# Should output: Module is enabled
```

## Configuration

Navigate to **Stores > Configuration > RequestDesk > Blog**

### General Settings

| Setting | Description |
|---------|-------------|
| Enable Blog | Enable/disable blog functionality on frontend |
| Blog Title | Title displayed on blog listing page |
| Posts Per Page | Number of posts per page (default: 10) |

### RequestDesk API Configuration

| Setting | Description |
|---------|-------------|
| API Key | Your RequestDesk API key (encrypted in database) |
| RequestDesk API Endpoint | API URL (default: `https://app.requestdesk.ai`) |
| Test Connection | Button to verify API connectivity |

### Automated Import

| Setting | Description |
|---------|-------------|
| Enable Automatic Import | Import published posts from RequestDesk every hour |

### SEO Settings

| Setting | Description |
|---------|-------------|
| Blog URL Prefix | URL prefix for blog pages (default: `blog`) |
| Default Meta Title | Default meta title for blog listing |
| Default Meta Description | Default meta description for blog listing |

## Admin Panel

### Content > RequestDesk Blog > Posts

Manage all blog posts with:
- Grid view with filtering and sorting
- Edit/View/Delete actions
- Sync status indicators
- RequestDesk Post ID tracking

### Content > RequestDesk Blog > Import Posts

Manual import interface:
- Test API connection
- Import posts by status (published/draft)
- View import results

### Content > RequestDesk Blog > Sync Products

Export products to RequestDesk:
- Test API connection
- Sync all products or limited batches
- View sync statistics

## REST API Endpoints

### Blog Post Management (JWT Auth)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/V1/requestdesk/blog/posts` | Create or update post |
| `GET` | `/V1/requestdesk/blog/posts` | List all posts |
| `GET` | `/V1/requestdesk/blog/posts/:postId` | Get single post |
| `DELETE` | `/V1/requestdesk/blog/posts/:postId` | Delete post |
| `PUT` | `/V1/requestdesk/blog/posts/:postId/sync-status` | Update sync status |

### Product Linking (JWT Auth)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/V1/requestdesk/blog/posts/:postId/products` | Link products to post |
| `GET` | `/V1/requestdesk/blog/posts/:postId/products` | Get linked products |
| `GET` | `/V1/requestdesk/blog/products/:productId/posts` | Get posts for product |

### Data Export (API Key Auth via `X-RequestDesk-Key`)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/V1/requestdesk/export/test` | Test connection |
| `GET` | `/V1/requestdesk/export/products` | Export products |
| `GET` | `/V1/requestdesk/export/categories` | Export categories |
| `GET` | `/V1/requestdesk/export/cms-pages` | Export CMS pages |

### External Blog API (API Key Auth via `X-RequestDesk-Key`)

These endpoints allow RequestDesk to push content to Magento:

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/V1/requestdesk/external/blog/test` | Test connection |
| `POST` | `/V1/requestdesk/external/blog/posts` | Create blog post |
| `GET` | `/V1/requestdesk/external/blog/posts` | List blog posts |
| `GET` | `/V1/requestdesk/external/blog/posts/:postId` | Get single post |
| `PUT` | `/V1/requestdesk/external/blog/posts/:postId` | Update post |
| `DELETE` | `/V1/requestdesk/external/blog/posts/:postId` | Delete post |

## Database Schema

### `requestdesk_blog_post`

Main blog posts table with RequestDesk sync tracking.

| Column | Type | Description |
|--------|------|-------------|
| `post_id` | int | Primary key |
| `title` | varchar(255) | Post title |
| `content` | mediumtext | Post content (HTML) |
| `url_key` | varchar(255) | SEO-friendly URL slug |
| `meta_title` | varchar(255) | SEO meta title |
| `meta_description` | text | SEO meta description |
| `featured_image` | varchar(255) | Featured image path |
| `status` | smallint | 0=Draft, 1=Published |
| `author` | varchar(255) | Author name |
| `store_id` | int | Magento store ID |
| `requestdesk_post_id` | varchar(50) | RequestDesk post ID |
| `requestdesk_sync_status` | varchar(20) | synced/pending/failed |
| `requestdesk_last_sync` | timestamp | Last sync timestamp |
| `created_at` | timestamp | Creation date |
| `updated_at` | timestamp | Last update date |

### `requestdesk_blog_category`

Blog categories with store scoping.

| Column | Type | Description |
|--------|------|-------------|
| `category_id` | int | Primary key |
| `name` | varchar(255) | Category name |
| `url_key` | varchar(255) | SEO-friendly URL slug |
| `description` | text | Category description |
| `status` | smallint | 0=Disabled, 1=Enabled |
| `sort_order` | int | Display order |
| `store_id` | int | Magento store ID |

### `requestdesk_blog_post_category`

Many-to-many relationship between posts and categories.

### `requestdesk_blog_product`

Product-to-post linking (critical for Magento e-commerce SEO).

| Column | Type | Description |
|--------|------|-------------|
| `id` | int | Primary key |
| `post_id` | int | Blog post ID |
| `product_id` | int | Magento product entity ID |
| `position` | int | Display position |

## Cron Jobs

| Job | Schedule | Description |
|-----|----------|-------------|
| `requestdesk_blog_import_posts` | Every hour (`0 * * * *`) | Imports published posts from RequestDesk |

Enable/disable via **Stores > Configuration > RequestDesk > Blog > Automated Import**.

## Frontend URLs

| Route | Description |
|-------|-------------|
| `/blog` | Blog listing page |
| `/blog/post/view/id/:postId` | Single post view |
| `/blog/category/:urlKey` | Category listing |

## ACL Permissions

| Resource | Description |
|----------|-------------|
| `RequestDesk_Blog::blog` | Access RequestDesk Blog section |
| `RequestDesk_Blog::view` | View blog posts |
| `RequestDesk_Blog::manage` | Create/edit/delete blog posts |
| `RequestDesk_Blog::sync` | Sync products to RequestDesk |
| `RequestDesk_Blog::import` | Import posts from RequestDesk |
| `RequestDesk_Blog::config` | Access configuration |

## How It Works

### Product Sync Flow (Magento → RequestDesk)

```
1. Admin clicks "Sync Products" in Magento
2. Extension collects visible products with:
   - Name, SKU, price, description
   - Categories, images, attributes
3. Products sent to RequestDesk API
4. RequestDesk stores in knowledge base
5. AI can now generate content about your products
```

### Post Import Flow (RequestDesk → Magento)

```
1. Create blog post in RequestDesk (manually or AI-generated)
2. Set post status to "Published"
3. Hourly cron job runs OR admin clicks "Import Posts"
4. Extension fetches posts via RequestDesk API
5. Posts created/updated in Magento
6. Sync status reported back to RequestDesk
```

### API Key Authentication

External API endpoints use header-based authentication:

```bash
curl -X GET "https://your-store.com/rest/V1/requestdesk/export/products" \
  -H "X-RequestDesk-Key: your-api-key"
```

## Hyvä Theme Support

The extension includes optimized templates for [Hyvä Theme](https://hyva.io/):

- `view/frontend/templates/hyva/list.phtml` - Blog listing
- `view/frontend/templates/hyva/post/view.phtml` - Post detail
- `view/frontend/layout/hyva_blog_*.xml` - Layout handles

These templates use Alpine.js and Tailwind CSS patterns consistent with Hyvä.

## Troubleshooting

### "Invalid security or form key" Error

Admin URLs require form keys. Always navigate via the admin menu:
**Content > RequestDesk Blog > Posts**

### API Connection Failed

1. Verify API key in configuration
2. Check endpoint URL (default: `https://app.requestdesk.ai`)
3. Use "Test Connection" button to diagnose
4. Check `var/log/system.log` for detailed errors

### Posts Not Importing

1. Ensure cron is running: `bin/magento cron:run`
2. Check "Enable Automatic Import" is set to Yes
3. Verify posts are "Published" status in RequestDesk
4. Check `var/log/system.log` for import errors

### Products Not Syncing

1. Verify products are enabled and visible
2. Check API key permissions in RequestDesk
3. Review `var/log/system.log` for sync errors

## Development

### Running Tests

```bash
# Unit tests
vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist \
  app/code/RequestDesk/Blog/Test/Unit

# Integration tests
vendor/bin/phpunit -c dev/tests/integration/phpunit.xml.dist \
  app/code/RequestDesk/Blog/Test/Integration
```

### Code Quality

This extension follows Magento coding standards:
- PSR-4 autoloading
- Proper dependency injection (no ObjectManager anti-pattern)
- Service contracts via interfaces
- Declarative schema

## Support

- **Magento Integration Guide**: [requestdesk.ai/magento](https://requestdesk.ai/magento)
- **Documentation**: [docs.requestdesk.ai](https://docs.requestdesk.ai)
- **Issues**: [GitHub Issues](https://github.com/brentwpeterson/requestdesk-magento/issues)
- **Email**: support@requestdesk.ai

## License

This extension is licensed under the [Open Software License 3.0 (OSL-3.0)](https://opensource.org/licenses/OSL-3.0).

Copyright (c) 2025 Content Basis LLC

## Roadmap

### WYSIWYG Editor (Planned)

Full rich-text editing for blog posts directly in the Magento admin.

- TinyMCE integration (Magento native)
- Image upload and media gallery integration
- Product widget insertion
- HTML source editing
- Responsive preview

---

### Brand Analyzer & Content Scoring (Planned)

A comprehensive brand consistency and content quality analyzer for your entire Magento store.

**Content Types Analyzed:**
- CMS Pages
- Category Descriptions
- Product Descriptions
- Blog Posts

**Scoring Dimensions:**
| Dimension | Description |
|-----------|-------------|
| Brand Voice | Consistency with defined brand tone and messaging |
| SEO Quality | Meta tags, keyword usage, heading structure |
| Readability | Reading level, sentence complexity, clarity |
| Completeness | Required fields, content length, media presence |
| Uniqueness | Duplicate content detection across pages |

**Features:**
- Dashboard with store-wide content health score
- Individual page scores with improvement suggestions
- Brand voice guidelines integration from RequestDesk personas
- Bulk analysis via cron for large catalogs
- Score history tracking over time
- Export reports for stakeholders

**Integration with RequestDesk:**
- Pull brand guidelines from your RequestDesk persona
- AI-powered suggestions for content improvements
- One-click content regeneration for low-scoring pages

---

### AEO Score - AI Search Optimization (Planned)

Optimize your content to be found and cited by AI assistants (ChatGPT, Claude, Perplexity, Google AI Overviews).

**What is AEO?**
Answer Engine Optimization (AEO) is the practice of structuring content so AI systems can easily understand, extract, and cite it in responses. As more users search via AI, traditional SEO alone isn't enough.

**AEO Scoring Dimensions:**
| Dimension | Description |
|-----------|-------------|
| Question Targeting | Content answers specific questions users ask AI |
| Structured Data | Schema.org markup for AI comprehension |
| Concise Answers | Clear, quotable statements AI can extract |
| Authority Signals | E-E-A-T factors that make AI trust your content |
| Source Attribution | Proper citations and references |
| Content Freshness | Recent updates that AI systems prefer |

**Features:**
- Per-page AEO score with specific recommendations
- Question extraction: "What questions does this page answer?"
- AI citation checker: See if your content appears in AI responses
- Structured data generator for products and articles
- Competitor AEO comparison
- "AI-ready" content templates

**Why This Matters:**
- 40% of Gen Z prefers TikTok/AI over Google for search
- AI Overviews now appear in 30%+ of Google searches
- Content not optimized for AI will become invisible

## Changelog

### 1.1.0 (2025-12-29)
- **Package renamed** from `requestdesk/module-blog` to `requestdesk/magento-blog`
- Establishes multi-platform naming convention (`magento-*`, `wordpress-*`, etc.)

### 1.0.0 (2025-12-29)
- Initial release
- Full blog system with posts and categories
- Product-to-post linking
- RequestDesk API integration
- Product export to RequestDesk knowledge base
- Post import from RequestDesk
- Automated hourly imports via cron
- REST API for headless implementations
- Hyvä theme support
- Multi-store support
