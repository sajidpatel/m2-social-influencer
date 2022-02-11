<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerInterfaceFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerRepositoryInterface;

class CreateInfluencer
{
    /**
     * @var InfluencerRepositoryInterface
     */
    private $influencerRepository;
    /**
     * @var InfluencerInterfaceFactory
     */
    private $influencerInterfaceFactory;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param InfluencerRepositoryInterface $influencerRepository
     * @param InfluencerInterfaceFactory $influencerInterfaceFactory
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        InfluencerRepositoryInterface $influencerRepository,
        InfluencerInterfaceFactory $influencerInterfaceFactory
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->influencerRepository = $influencerRepository;
        $this->influencerInterfaceFactory = $influencerInterfaceFactory;
    }

    /**
     * @param array $data
     * @return InfluencerInterface
     * @throws LocalizedException
     */
    public function execute(array $data): InfluencerInterface
    {
        try {
            $this->vaildateData($data);
            $influencer = $this->createInfluencer($data);
        } catch (LocalizedException $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return $influencer;
    }

    /**
     * Guard function to handle bad request.
     * @param array $data
     * @throws LocalizedException
     */
    private function vaildateData(array $data)
    {
        if (!isset($data[InfluencerInterface::SOCIAL_NAME])) {
            throw new LocalizedException(__('Social Name must be set'));
        }
    }

    /**
     * @param array $data
     * @return InfluencerInterface
     * @throws CouldNotSaveException
     * @throws LocalizedException
     */
    private function createInfluencer(array $data): InfluencerInterface
    {
        /** @var InfluencerInterfaceFactory $influencerDataObject */
        $influencerDataObject = $this->influencerInterfaceFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $influencerDataObject,
            $data,
            InfluencerInterface::class
        );

        try {
            return $this->influencerRepository->save($influencerDataObject);
        } catch (LocalizedException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }
}
