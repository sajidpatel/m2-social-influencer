<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver\DataProvider;

use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;
use SajidPatel\SocialInfluencer\Api\InfluencerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class InfluencerDataProvider
{
    /**
     * @var InfluencerRepositoryInterface
     */
    protected $influencerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var InfluencerProductRepositoryInterface
     */
    protected $influencerProductRepository;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * InfluencerDataProvider constructor.
     * @param Builder $builder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param InfluencerRepositoryInterface $influencerRepository
     * @param InfluencerProductRepositoryInterface $influencerProductRepository
     */
    public function __construct(
        Builder $builder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        InfluencerRepositoryInterface $influencerRepository,
        InfluencerProductRepositoryInterface $influencerProductRepository
    ) {
        $this->builder = $builder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->influencerRepository = $influencerRepository;
        $this->influencerProductRepository = $influencerProductRepository;
    }

    public function getData($filter)
    {
        $searchCriteria = $this->builder->build('social_influencer', $filter);
        if (isset($filter['currentPage'])) {
            $searchCriteria->setCurrentPage($filter['currentPage']);
        }

        if (isset($filter['pageSize'])) {
            $searchCriteria->setPageSize($filter['pageSize']);
        }

        $searchResult = $this->influencerRepository->getList($searchCriteria);
        $influencerArr = [];

        foreach ($searchResult->getItems() as $influencer) {
            $influencerArr[$influencer->getId()] = $influencer->getData();
            $searchCriteria = $this->searchCriteriaBuilder->addFilter('influencer_id', $influencer->getId())->create();
            $influencerArr[$influencer->getId()]['products'] = $this->influencerProductRepository->getList($searchCriteria)->getItems();
        }

        return [
            'total_count' => $searchResult->getTotalCount(),
            'influencers' => $influencerArr,
        ];
    }
}
