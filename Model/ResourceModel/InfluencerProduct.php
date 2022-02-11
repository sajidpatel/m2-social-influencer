<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class InfluencerProduct extends AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('social_influencer_product', 'id');
    }
}

