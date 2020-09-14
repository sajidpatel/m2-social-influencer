<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface InfluencerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Influencer list.
     * @return InfluencerInterface[]
     */
    public function getItems();

    /**
     * Set created_at list.
     * @param InfluencerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

