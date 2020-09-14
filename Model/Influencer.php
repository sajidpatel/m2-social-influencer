<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterfaceFactory;
use SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer\Collection;

class Influencer extends AbstractModel implements IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = "social_influencer";

    /**
     * @var string
     */
    protected $_cacheTag = 'social_influencer';

    /**
     * @var string
     */
    protected $_eventPrefix = 'social_influencer';

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var InfluencerInterfaceFactory
     */
    protected $influencerDataFactory;

    /**
     * @var ResourceModel\Influencer
     */
    private $resource;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param InfluencerInterfaceFactory $influencerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Influencer $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        InfluencerInterfaceFactory $influencerDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Influencer $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->resource = $resource;
        $this->influencerDataFactory = $influencerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve influencer model with influencer data
     * @return InfluencerInterface
     */
    public function getDataModel()
    {
        $influencerData = $this->getData();

        $influencerDataObject = $this->influencerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $influencerDataObject,
            $influencerData,
            InfluencerInterface::class
        );

        return $influencerDataObject;
    }

    public function getResourceModel()
    {
        return $this->resource;
    }
}

