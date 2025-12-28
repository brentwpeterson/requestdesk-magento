<?php
/**
 * RequestDesk Connection Test Controller
 *
 * Admin controller for testing RequestDesk API connection.
 *
 * @category  RequestDesk
 * @package   RequestDesk_Blog
 */

declare(strict_types=1);

namespace RequestDesk\Blog\Controller\Adminhtml\Sync;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use RequestDesk\Blog\Service\ProductExportService;
use Psr\Log\LoggerInterface;

class Test extends Action
{
    /**
     * Authorization level
     */
    public const ADMIN_RESOURCE = 'RequestDesk_Blog::config';

    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * @var ProductExportService
     */
    private ProductExportService $productExportService;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param ProductExportService $productExportService
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ProductExportService $productExportService,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productExportService = $productExportService;
        $this->logger = $logger;
    }

    /**
     * Execute connection test
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        try {
            $this->logger->info('RequestDesk: Connection test initiated from admin');

            $result = $this->productExportService->testConnection();

            if ($result['success']) {
                $message = $result['agent_name']
                    ? __('Connected to RequestDesk! Agent: %1', $result['agent_name'])
                    : __('Connected to RequestDesk successfully!');
                $this->messageManager->addSuccessMessage($message);
            } else {
                $this->messageManager->addErrorMessage(
                    __('Connection failed: %1', $result['error'] ?? 'Unknown error')
                );
            }

            return $resultJson->setData($result);

        } catch (\Exception $e) {
            $this->logger->error('RequestDesk: Connection test failed - ' . $e->getMessage());
            $this->messageManager->addErrorMessage(__('Connection test failed: %1', $e->getMessage()));

            return $resultJson->setData([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
