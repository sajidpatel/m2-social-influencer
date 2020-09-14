<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductSearchResultsInterface;

interface InfluencerProductRepositoryInterface
{

    /**
     * Save Influencer_product
     * @param \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface $influencerProduct
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     * @throws LocalizedException
     */
    public function save(
        \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface $influencerProduct
    );

    /**
     * Retrieve Influencer_product
     * @param string $id
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface
     * @throws LocalizedException
     */
    public function get($id);

    /**
     * Retrieve Influencer_product matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Retrieve Influencer_product matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductSearchResultsInterface
     * @throws LocalizedException
     */
    public function getSkus(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Influencer_product
     * @param \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface $influencerProduct
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        \SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface $influencerProduct
    );

    /**
     * Delete Influencer_product by ID
     * @param string $sku
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteByInfluencerIdSku($sku);
}

