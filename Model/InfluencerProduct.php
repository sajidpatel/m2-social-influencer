<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterfaceFactory;
use SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct\Collection;

class InfluencerProduct extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = "social_influencer_products";

    protected $_cacheTag = 'social_influencer_products';

    protected $influencer_productDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'social_influencer_product';
    /**
     * @var ResourceModel\InfluencerProduct
     */
    protected $resource;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param InfluencerProductInterfaceFactory $influencer_productDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\InfluencerProduct $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        InfluencerProductInterfaceFactory $influencer_productDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\InfluencerProduct $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->resource = $resource;
        $this->influencer_productDataFactory = $influencer_productDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve influencer_product model with influencer_product data
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function getDataModel()
    {
        $influencer_productData = $this->getData();

        $influencer_productDataObject = $this->influencer_productDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $influencer_productDataObject,
            $influencer_productData,
            InfluencerProductInterface::class
        );

        return $influencer_productDataObject;
    }

    /**
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function getResourceModel()
    {
        return $this->resource;
    }
}

