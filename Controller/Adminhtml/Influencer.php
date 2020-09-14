<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerRepositoryInterface;
use SajidPatel\SocialInfluencer\Model\InfluencerFactory;

abstract class Influencer extends Action
{
    const ADMIN_RESOURCE = 'SajidPatel_SocialInfluencer::top_level';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var InfluencerRepositoryInterface
     */
    protected $influencerRepository;

    /**
     * @var InfluencerFactory
     */
    protected $influencerFactory;

    /**
     * Influencer constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param ForwardFactory $resultForwardFactory
     * @param DataPersistorInterface $dataPersistor
     * @param InfluencerRepositoryInterface $influencerRepository
     * @param InfluencerFactory $influencerFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        ForwardFactory $resultForwardFactory,
        DataPersistorInterface $dataPersistor,
        InfluencerRepositoryInterface $influencerRepository,
        InfluencerFactory $influencerFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->dataPersistor = $dataPersistor;
        $this->influencerRepository = $influencerRepository;
        $this->influencerFactory = $influencerFactory;

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
            ->addBreadcrumb(__('Influencer'), __('Influencer'));
        return $resultPage;
    }
}
