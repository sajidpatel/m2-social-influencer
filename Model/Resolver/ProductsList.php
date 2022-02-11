<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver;

use Exception;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SajidPatel\SocialInfluencer\Model\Resolver\DataProvider\InfluencerDataProvider;
use SajidPatel\SocialInfluencer\Model\Resolver\DataProvider\InfluencerProductDataProvider;

class ProductsList implements ResolverInterface
{
    /**
     * @var DataProvider\InfluencerDataProvider
     */
    private $dataProvider;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var InfluencerDataProvider
     */
    private $influencerDataProvider;

    /**
     * ProductsList constructor.
     * @param InfluencerProductDataProvider $dataProvider
     * @param InfluencerDataProvider $influencerDataProvider
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        InfluencerProductDataProvider $dataProvider,
        InfluencerDataProvider $influencerDataProvider,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->dataProvider = $dataProvider;
        $this->influencerDataProvider = $influencerDataProvider;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed|Value
     * @throws Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $filters = $this->getFilters($value);

        $searchResult = $this->dataProvider->getData($filters);
        return $searchResult['products'];
    }

    /**
     * @param array|null $value
     * @return array
     */
    protected function getFilters(?array $value): array
    {
        $filters = [];
        $filters['filter']['influencer_id']['eq'] = $value['id'];
        return $filters;
    }
}
