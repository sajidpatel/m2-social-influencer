<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver\DataProvider;

use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;

class InfluencerProductDataProvider
{
    /**
     * @var InfluencerProductRepositoryInterface
     */
    private $influencerProductRepository;

    /**
     * @var Builder
     */
    private $builder;

    /**
     * InfluencerProductDataProvider constructor.
     * @param Builder $builder
     * @param InfluencerProductRepositoryInterface $influencerProductRepository
     */
    public function __construct(
        Builder $builder,
        InfluencerProductRepositoryInterface $influencerProductRepository
    ) {
        $this->builder = $builder;
        $this->influencerProductRepository = $influencerProductRepository;
    }

    public function getData($filters)
    {
        $searchCriteria = $this->builder->build('social_influencer_product', $filters);

        if (isset($filter['currentPage'])) {
            $searchCriteria->setCurrentPage($filter['currentPage']);
        }

        if (isset($filter['pageSize'])) {
            $searchCriteria->setPageSize($filter['pageSize']);
        }

        $searchResult = $this->influencerProductRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        return [
            'total_count' => $searchResult->getTotalCount(),
            'products' => $items,
        ];
    }
}
