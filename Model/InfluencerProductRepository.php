<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductSearchResultsInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductSearchResultsInterfaceFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;
use SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct as ResourceInfluencerProduct;
use SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct\CollectionFactory as InfluencerProductCollectionFactory;

class InfluencerProductRepository implements InfluencerProductRepositoryInterface, IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = "influencer_products";

    /**
     * @var string
     */
    protected $_cacheTag = 'influencer_products';

    /**
     * @var string
     */
    protected $_eventPrefix = 'influencer_products';

    /**
     * @var InfluencerProductSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @var InfluencerProductFactory
     */
    protected $influencerProductFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var InfluencerProductCollectionFactory
     */
    protected $influencerProductCollectionFactory;

    /**
     * @var ResourceInfluencerProduct
     */
    protected $resource;

    /**
     * @var InfluencerRepository
     */
    private $influencerRepository;

    /**
     * InfluencerProductRepository constructor.
     * @param ResourceInfluencerProduct $resource
     * @param InfluencerProductFactory $influencerProductFactory
     * @param InfluencerProductCollectionFactory $influencerProductCollectionFactory
     * @param InfluencerProductSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param InfluencerRepository $influencerRepository
     */
    public function __construct(
        ResourceInfluencerProduct $resource,
        InfluencerProductFactory $influencerProductFactory,
        InfluencerProductCollectionFactory $influencerProductCollectionFactory,
        InfluencerProductSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        InfluencerRepository $influencerRepository
    ) {
        $this->resource = $resource;
        $this->influencerProductFactory = $influencerProductFactory;
        $this->influencerProductCollectionFactory = $influencerProductCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->influencerRepository = $influencerRepository;
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        InfluencerProductInterface $influencerProduct
    ) {
        $influencerProductModel = $this->influencerProductFactory->create()->setData($influencerProduct->getData());

        try {
            $this->resource->save($influencerProductModel);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the influencerProduct: %1',
                $exception->getMessage()
            ));
        }
        return $this->get($influencerProductModel->getDataModel()->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $influencerProduct = $this->influencerProductFactory->create();
        $this->resource->load($influencerProduct, $id);
        if (!$influencerProduct->getId()) {
            throw new NoSuchEntityException(__('Influencer_product with id "%1" does not exist.', $id));
        }
        return $influencerProduct->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    ) {
        $collection = $this->influencerProductCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $id = $model->getDataModel()->getId();
            $items[$id] = $model->getDataModel()->getData();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function getSkus(
        SearchCriteriaInterface $criteria
    ) {
        $collection = $this->influencerProductCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel()->getSku();
        }

        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        InfluencerProductInterface $influencerProduct
    ) {
        try {
            $influencerProductModel = $this->influencerProductFactory->create();
            $this->resource->load($influencerProductModel, $influencerProduct->getId());
            $this->resource->delete($influencerProductModel);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Influencer_product for sku: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByInfluencerIdSku($sku)
    {
        return $this->delete($this->get($sku));
    }
}
