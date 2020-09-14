<?php declare(strict_types=1);


namespace SajidPatel\SocialInfluencer\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;
use SajidPatel\SocialInfluencer\Model\InfluencerProductFactory;

abstract class InfluencerProduct extends Action
{
    const ADMIN_RESOURCE = 'SajidPatel_SocialInfluencer::top_level';

    /**
     * @var InfluencerProductRepositoryInterface
     */
    protected $influencerProductRepository;

    /**
     * @var InfluencerProductFactory
     */
    protected $influencerProductFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param ForwardFactory $resultForwardFactory
     * @param InfluencerProductFactory $influencerProductFactory
     * @param InfluencerProductRepositoryInterface $influencerProductRepository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        ForwardFactory $resultForwardFactory,
        InfluencerProductFactory $influencerProductFactory,
        InfluencerProductRepositoryInterface $influencerProductRepository,
        DataPersistorInterface $dataPersistor
    ) {
        $this->influencerProductRepository = $influencerProductRepository;
        $this->influencerProductFactory = $influencerProductFactory;
        $this->dataPersistor = $dataPersistor;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultForwardFactory = $resultForwardFactory;

        parent::__construct($context);

    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Social'), __('Social'))
            ->addBreadcrumb(__('Influencer Product'), __('Influencer Product'));
        return $resultPage;
    }
}

