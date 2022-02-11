<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\ResourceModel;

class Influencer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('social_influencer', 'id');
    }
}

