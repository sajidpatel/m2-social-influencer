<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Data;

use Magento\Framework\Model\AbstractModel;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;

class Influencer extends AbstractModel implements InfluencerInterface
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
     * @return InfluencerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
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
     * @return InfluencerInterface
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
     * @return InfluencerInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return InfluencerInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get social_name
     * @return string
     */
    public function getSocialName()
    {
        return $this->getData(self::SOCIAL_NAME);
    }

    /**
     * Set social_name
     * @param string $socialName
     * @return InfluencerInterface
     */
    public function setSocialName($socialName)
    {
        return $this->setData(self::SOCIAL_NAME, $socialName);
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
     * @return InfluencerInterface
     */
    public function setEnabled($enabled)
    {
        return $this->setData(self::ENABLED, $enabled);
    }
}

