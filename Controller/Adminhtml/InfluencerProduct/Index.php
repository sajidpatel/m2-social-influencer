<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

class Index extends InfluencerProduct
{
    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Influencer_product"));
        return $resultPage;
    }
}
