<?php declare(strict_types=1);

    namespace SajidPatel\SocialInfluencer\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;
use \SajidPatel\SocialInfluencer\Model\Resolver\DataProvider\InfluencerProductDataProvider;

class InfluencerProduct implements ResolverInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var InfluencerProductRepositoryInterface
     */
    private $influencerProductRepository;
    /**
     * @var InfluencerProductDataProvider
     */
    private $influencerProductDataProvider;

    /**
     * InfluencerProducts constructor.
     * @param InfluencerProductDataProvider $influencerProductDataProvider
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        InfluencerProductDataProvider $influencerProductDataProvider,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->influencerProductDataProvider = $influencerProductDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $this->vaildateArgs($args);
        return $this->influencerProductDataProvider->getData($args);
    }

    /**
     * @param array $args
     * @throws GraphQlInputException
     */
    private function vaildateArgs(array $args): void
    {
        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }

        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }
}
