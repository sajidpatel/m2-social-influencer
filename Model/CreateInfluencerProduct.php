<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterface;
use SajidPatel\SocialInfluencer\Api\Data\InfluencerProductInterfaceFactory;
use SajidPatel\SocialInfluencer\Api\InfluencerProductRepositoryInterface;

class CreateInfluencerProduct
{
    /**
     * @var InfluencerProductRepositoryInterface
     */
    private $influencerProductRepository;
    /**
     * @var InfluencerProductInterfaceFactory
     */
    private $influencerProductInterfaceFactory;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param InfluencerProductRepositoryInterface $influencerRepository
     * @param InfluencerProductInterfaceFactory $influencerInterfaceFactory
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        InfluencerProductRepositoryInterface $influencerProductRepository,
        InfluencerProductInterfaceFactory $influencerProductInterfaceFactory
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->influencerProductRepository = $influencerProductRepository;
        $this->influencerProductInterfaceFactory = $influencerProductInterfaceFactory;
    }

    /**
     * @param array $data
     * @return InfluencerProductInterface[]
     * @throws GraphQlInputException
     * @throws \Exception
     */
    public function execute(array $data): InfluencerProductInterface
    {
        try {
            $this->vaildateData($data);
            $influencer = $this->createInfluencerProduct($data);
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
        if (!isset($data[InfluencerProductInterface::SKU])) {
            throw new LocalizedException(__('Sku must be set'));
        }
    }

    /**
     * @param array $data
     * @return InfluencerInterface
     * @throws CouldNotSaveException
     * @throws LocalizedException
     */
    private function createInfluencerProduct(array $data): InfluencerProductInterface
    {
        /** @var InfluencerProductInterfaceFactory $influencerProductDataObject */
        $influencerProductDataObject = $this->influencerProductInterfaceFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $influencerProductDataObject,
            $data,
            InfluencerProductInterface::class
        );

        try {
            return $this->influencerProductRepository->save($influencerProductDataObject);
        } catch (LocalizedException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }
}
