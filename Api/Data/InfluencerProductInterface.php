<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api\Data;

interface InfluencerProductInterface
{
    const ID = 'id';
    const INFLUENCER_ID = 'influencer_id';
    const SKU = 'sku';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const ENABLED = 'enabled';

    /**
     * Get id
     * @return string
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setId($id);

    /**
     * Get sku
     * @return string
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setSku($sku);

    /**
     * Get influencer_id
     * @return string
     */
    public function getInfluencerId();

    /**
     * Set influencer_id
     * @param string $influencerId
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setInfluencerId($influencerId);

    /**
     * Get enabled
     * @return string
     */
    public function getEnabled();

    /**
     * Set enabled
     * @param string $enabled
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setEnabled($enabled);

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setUpdatedAt($updatedAt);
}
