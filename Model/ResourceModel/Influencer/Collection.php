<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer;

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
            \SajidPatel\SocialInfluencer\Model\Influencer::class,
            \SajidPatel\SocialInfluencer\Model\ResourceModel\Influencer::class
        );
    }

    public function joinProductsInfluencer()
    {
        return $this->join(['siip' => 'social_influencer_product'], 'siip.influencer_id=main_table.id', ['influencer_id' => 'influencer_id']);
    }
}

