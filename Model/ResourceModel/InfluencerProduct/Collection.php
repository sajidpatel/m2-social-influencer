<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct;

use SajidPatel\SocialInfluencer\Model\InfluencerProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            InfluencerProduct::class,
            \SajidPatel\SocialInfluencer\Model\ResourceModel\InfluencerProduct::class
        );
    }

    public function joinProductsInfluencer()
    {
        return $this->join(['sii' => 'social_influencer'], 'sii.influencer_id=main_table.influencer_id', ['social_name' => 'name', 'influencer_id' => 'sii.influencer_id']);
    }

    public function addSkuFilter($sku)
    {
        return $this->addFieldToFilter("sku", ["like" => $sku]);
    }

    public function addInfluencerIdFilter($influencer_id)
    {
        return $this->addFieldToFilter("influencer_id", ["eq" => $influencer_id]);
    }
}

