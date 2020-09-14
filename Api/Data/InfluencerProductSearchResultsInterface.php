<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface InfluencerProductSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Influencer_product list.
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface[]
     */
    public function getItems();

    /**
     * Set sku list.
     * @param \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

