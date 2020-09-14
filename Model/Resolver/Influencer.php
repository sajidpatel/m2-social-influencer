<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SajidPatel\SocialInfluencer\Model\InfluencerRepository;
use SajidPatel\SocialInfluencer\Model\Resolver\DataProvider\InfluencerDataProvider;

class Influencer implements ResolverInterface
{
    /**
     * @var Builder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var InfluencerDataProvider
     */
    protected $influencerDataProvider;

    /**
     * @var InfluencerRepository
     */
    protected $influencerRepository;

    /**
     * Influencer constructor.
     * @param InfluencerRepository $influencerRepository
     * @param InfluencerDataProvider $influencerDataProvider
     * @param Builder $searchCriteriaBuilder
     */
    public function __construct(
        InfluencerRepository $influencerRepository,
        InfluencerDataProvider $influencerDataProvider,
        Builder $searchCriteriaBuilder
    ) {
        $this->influencerRepository = $influencerRepository;
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
     * @throws \Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $data = null;
        if ($args) {
            $this->vaildateArgs($args);
            $data = $this->influencerDataProvider->getData($args);
        } elseif ($value['influencer_id']) {
            $influencer = $this->influencerRepository->get($value['influencer_id']);
            $data = $influencer->getData();
        }

        return $data;
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
