<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver\Products;

use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;

class ProductsListIdentity implements IdentityInterface
{

    /** @var string */
    private $cacheTag = 'products_list';

    /**
     * Get identity tags from resolved data.
     *
     * Example: identityTag, identityTag_UniqueId.
     *
     * @param array $resolvedData
     * @return string[]
     */
    public function getIdentities(array $resolvedData): array
    {
        $ids = [];
        $items = $resolvedData['items'] ?? [];
        foreach ($items as $item) {
            if (is_array($item) && !empty($item[InfluencerInterface::INFLUENCER_ID])) {
                $ids[] = sprintf('%s_%s', $this->cacheTag, $item[InfluencerInterface::INFLUENCER_ID]);
            }
        }

        if (!empty($ids)) {
            array_unshift($ids, $this->cacheTag);
        }

        return $ids;
    }
}
