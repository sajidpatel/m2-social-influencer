<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\Api;

use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;

interface SocialInfluencerProductsSessionRepositoryInterface
{
    /**
     * @return string[]
     */
    public function getSkus();

    /**
     * @return string[]
     */
    public function getInfluencer();

    /**
     * @param string $sku
     * @param string $influencer_id
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function addBySku($sku, $influencer_id);

    /**
     * @param string $sku
     * @param string $influencer_id
     * @return void
     */
    public function removeBySku($sku, $influencer_id);
}
