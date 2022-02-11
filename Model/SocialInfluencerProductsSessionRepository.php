<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Customer\Model\Session;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;
use SajidPatel\SocialInfluencer\Api\InfluencerRepositoryInterface;
use SajidPatel\SocialInfluencer\Api\SocialInfluencerProductsSessionRepositoryInterface;
use SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct\CollectionFactory as InfluencerProductCollectionFactory;

class SocialInfluencerProductsSessionRepository implements SocialInfluencerProductsSessionRepositoryInterface
{
    /**
     * @var SocialInfluencerProductsSession
     */
    protected $session;
    /**
     * @var InfluencerProductRepositoryInterface
     */
    protected $influencerProductRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var InfluencerProductFactory
     */
    protected $influencerProductFactory;

    /**
     * @var CreateInfluencerProduct
     */
    protected $createInfluencerProduct;
    /**
     * @var Session
     */
    protected $customerSession;
    /**
     * @var InfluencerRepositoryInterface
     */
    protected $influencerRepository;

    /**
     * @var Influencer
     */
    protected $influencer = null;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    protected $filterGroupBuilder;
    /**
     * @var InfluencerProductCollectionFactory
     */
    protected $influencerProductCollectionFactory;

    /**
     * @var array
     */
    protected $skus;

    /**
     * SocialInfluencerProductsSessionRepository constructor.
     * @param Session $customerSession
     * @param SocialInfluencerProductsSession $session
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param InfluencerProductFactory $influencerProductFactory
     * @param InfluencerProductCollectionFactory $influencerProductCollectionFactory
     * @param CreateInfluencerProduct $createInfluencerProduct
     * @param InfluencerRepositoryInterface $influencerRepository
     * @param InfluencerProductRepositoryInterface $influencerProductRepository
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     */
    public function __construct(
        Session $customerSession,
        SocialInfluencerProductsSession $session,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        InfluencerProductFactory $influencerProductFactory,
        InfluencerProductCollectionFactory $influencerProductCollectionFactory,
        CreateInfluencerProduct $createInfluencerProduct,
        InfluencerRepositoryInterface $influencerRepository,
        InfluencerProductRepositoryInterface $influencerProductRepository,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder
    ) {
        $this->session = $session;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->influencerRepository = $influencerRepository;
        $this->influencerProductRepository = $influencerProductRepository;
        $this->createInfluencerProduct = $createInfluencerProduct;
        $this->customerSession = $customerSession;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->influencerProductFactory = $influencerProductFactory;
        $this->influencerProductCollectionFactory = $influencerProductCollectionFactory;
    }

    /**
     * @return string[]
     */
    public function getInfluencer()
    {
        if ($this->influencer === null) {
            if ($this->customerSession->getCustomer()->getData()) {
                $searchCriteria = $this->searchCriteriaBuilder->addFilter(
                    'customer_id',
                    $this->customerSession->getCustomer()->getId()
                )->create();

                $influencer = $this->influencerRepository->getList($searchCriteria);
                $items = $influencer->getItems();
                $this->influencer = (count($items) ? $items[0]->getData() : []);
            }
        }

        return $this->influencer;
    }

    public function getSkus()
    {
        if ($this->skus === null) {
            if ($this->customerSession->getCustomer()->getData()) {
                $searchCriteria = $this->searchCriteriaBuilder->addFilter(
                    'influencer_id',
                    $this->getInfluencer()['id']
                )->create();

                $this->skus = $this->influencerProductRepository->getSkus($searchCriteria);
            } else {
                $this->skus = [];
            }

        }

        return array_unique(array_merge($this->skus, $this->session->getSocialInfluencerProducts()));
    }

    /**
     * @param string $sku
     * @param string $influencer_id
     * @return InfluencerProductInterface
     * @throws \Magento\Framework\GraphQl\Exception\GraphQlInputException
     */
    public function addBySku($sku, $influencer_id)
    {
        $product = $this->createInfluencerProduct->execute(
            [
                InfluencerProductInterface::INFLUENCER_ID => $influencer_id,
                InfluencerProductInterface::SKU => $sku,
                InfluencerProductInterface::ENABLED => 1
            ]
        );
        $this->session->addSocialInfluencerProduct($sku);
        return $product;

    }

    public function removeBySku($sku, $influencer_id)
    {
        if ($sku == 'undefined' || $influencer_id == 'undefined') {
            return ['message' => "Sku:$sku or Infuencer_id: $influencer_id is undefined"];
        }

        $productCollection = $this->influencerProductCollectionFactory->create();
        $productCollection
            ->addFieldToFilter(InfluencerProductInterface::INFLUENCER_ID, $influencer_id)
            ->addFieldToFilter(InfluencerProductInterface::SKU, $sku);
        $filterSku = $this->filterBuilder
            ->setField(InfluencerProductInterface::SKU)
            ->setConditionType('eq')
            ->setValue($sku)
            ->create();
        $filterInfluencerId = $this->filterBuilder
            ->setField(InfluencerProductInterface::INFLUENCER_ID)
            ->setConditionType('eq')
            ->setValue($influencer_id)
            ->create();

        $filter_group_1 = $this->filterGroupBuilder
            ->addFilter($filterSku)
            ->create();
        $filter_group_2 = $this->filterGroupBuilder
            ->addFilter($filterInfluencerId)
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$filter_group_1, $filter_group_2])
            ->create();

        $influencerProducts = $this->influencerProductRepository->getList($searchCriteria);
        foreach ($influencerProducts->getItems() as $product) {
            $productModel = $this->influencerProductFactory->create()->load($product['id']);
            $productModel->delete($productModel);
        }
        $this->session->removeSocialInfluencerProductSku($sku);

        return ['message' => "$sku removed from Influencer Product Data"];
    }
}
