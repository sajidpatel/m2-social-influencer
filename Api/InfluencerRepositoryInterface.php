<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerSearchResultsInterface;

interface InfluencerRepositoryInterface
{

    /**
     * Save Influencer
     * @param InfluencerInterface $influencer
     * @return InfluencerInterface
     * @throws LocalizedException
     */
    public function save(
        InfluencerInterface $influencer
    );

    /**
     * Retrieve Influencer
     * @param string $influencerId
     * @return InfluencerInterface
     * @throws LocalizedException
     */
    public function get($influencerId);

    /**
     * Retrieve Influencer matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return InfluencerSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Influencer
     * @param InfluencerInterface $influencer
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        InfluencerInterface $influencer
    );

    /**
     * Delete Influencer by ID
     * @param string $influencerId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($influencerId);
}

