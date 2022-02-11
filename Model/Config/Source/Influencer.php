<?php

namespace SajidPatel\SocialInfluencer\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer\Collection;

class Influencer implements ArrayInterface
{
    /**
     * @var Collection
     */
    protected $influencerCollection;

    /**
     * [__construct description]
     * @param Collection $influencerCollection [description]
     */
    public function __construct(
        Collection $influencerCollection
    ) {
        $this->influencerCollection = $influencerCollection;
    }

    public function toOptionArray()
    {
        $collection = $this->influencerCollection->getData();
        $options = [];

        foreach ($collection as $key => $value) {
            $options[] = ['value' => $value['id'], 'label' => $value['social_name']];
        }

        return $options;
    }
}
