<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api\Data;

interface InfluencerInterface
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const CUSTOMER_ID = 'customer_id';
    const SOCIAL_NAME = 'social_name';
    const ENABLED = 'enabled';
    const ID = 'id';

    /**
     * Get id
     * @return string
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return InfluencerInterface
     */
    public function setId($id);

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return InfluencerInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get social_name
     * @return string
     */
    public function getSocialName();

    /**
     * Set social_name
     * @param string $socialName
     * @return InfluencerInterface
     */
    public function setSocialName($socialName);

    /**
     * Get enabled
     * @return string
     */
    public function getEnabled();

    /**
     * Set enabled
     * @param string $enabled
     * @return InfluencerInterface
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
     * @return InfluencerInterface
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
     * @return InfluencerInterface
     */
    public function setUpdatedAt($updatedAt);
}
