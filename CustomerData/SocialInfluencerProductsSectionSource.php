<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use SajidPatel\SocialInfluencer\Api\SocialInfluencerProductsSessionRepositoryInterface;

class SocialInfluencerProductsSectionSource implements SectionSourceInterface
{
    /**
     * @var SocialInfluencerProductsSessionRepositoryInterface
     */
    private $socialInfluencerProductsRepository;

    public function __construct(SocialInfluencerProductsSessionRepositoryInterface $socialInfluencerProductsRepository)
    {
        $this->socialInfluencerProductsRepository = $socialInfluencerProductsRepository;
    }

    public function getSectionData()
    {
        return [
            'skus' => $this->socialInfluencerProductsRepository->getSkus(),
            'influencer' => $this->socialInfluencerProductsRepository->getInfluencer()
        ];
    }
}
