<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver;

use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;
use SajidPatel\SocialInfluencer\Model\Influencer;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface
{

    /**
     * @var string
     */
    private $cacheTag = Influencer::CACHE_TAG;

    /**
     * @param array $resolvedData
     * @return array
     */
    public function getIdentities(array $resolvedData): array
    {
        return empty($resolvedData[InfluencerInterface::INFLUENCER_ID]) ?
            [] : [$this->cacheTag, sprintf('%s_%s', $this->cacheTag, $resolvedData[InfluencerInterface::INFLUENCER_ID])];
    }
}
