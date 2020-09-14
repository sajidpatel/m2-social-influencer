<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Data;

use Magento\Framework\Model\AbstractModel;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;

class InfluencerProduct extends AbstractModel implements InfluencerProductInterface
{
    /**
     * Get id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get influencer_id
     * @return string
     */
    public function getInfluencerId()
    {
        return $this->getData(self::INFLUENCER_ID);
    }

    /**
     * Set influencer_id
     * @param string $influencerId
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setInfluencerId($influencerId)
    {
        return $this->setData(self::INFLUENCER_ID, $influencerId);
    }

    /**
     * Get sku
     * @return string
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get enabled
     * @return string
     */
    public function getEnabled()
    {
        return $this->getData(self::ENABLED);
    }

    /**
     * Set enabled
     * @param string $enabled
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setEnabled($enabled)
    {
        return $this->setData(self::ENABLED, $enabled);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}

