<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Exception;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterfaceFactory;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerSearchResultsInterfaceFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerRepositoryInterface;
use SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer as ResourceInfluencer;
use SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer\CollectionFactory as InfluencerCollectionFactory;

class InfluencerRepository implements InfluencerRepositoryInterface
{
    /**
     * @var InfluencerFactory
     */
    protected $influencerFactory;

    /**
     * @var InfluencerInterfaceFactory
     */
    protected $dataInfluencerFactory;

    /**
     * @var InfluencerCollectionFactory
     */
    protected $influencerCollectionFactory;

    /**
     * @var InfluencerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    protected $resource;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param ResourceInfluencer $resource
     * @param InfluencerFactory $influencerFactory
     * @param InfluencerInterfaceFactory $dataInfluencerFactory
     * @param InfluencerCollectionFactory $influencerCollectionFactory
     * @param InfluencerSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ResourceInfluencer $resource,
        InfluencerFactory $influencerFactory,
        InfluencerInterfaceFactory $dataInfluencerFactory,
        InfluencerCollectionFactory $influencerCollectionFactory,
        InfluencerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resource = $resource;
        $this->influencerFactory = $influencerFactory;
        $this->influencerCollectionFactory = $influencerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataInfluencerFactory = $dataInfluencerFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        InfluencerInterface $influencer
    ) {
        $influencerModel = $this->influencerFactory->create()->setData($influencer);

        try {
            $this->resource->save($influencerModel);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the influencer: %1',
                $exception->getMessage()
            ));
        }
        return $influencerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($influencerId)
    {
        $influencer = $this->influencerFactory->create();
        $this->resource->load($influencer, $influencerId);
        if (!$influencer->getId()) {
            throw new NoSuchEntityException(__('Influencer with id "%1" does not exist.', $influencerId));
        }
        return $influencer->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null)
    {
        $collection = $this->influencerCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        InfluencerInterface $influencer
    ) {
        try {
            $influencerModel = $this->influencerFactory->create();
            $this->resource->load($influencerModel, $influencer->getId());
            $this->resource->delete($influencerModel);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Influencer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($influencerId)
    {
        return $this->delete($this->get($influencerId));
    }
}
