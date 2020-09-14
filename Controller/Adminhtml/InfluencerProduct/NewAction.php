<?php declare(strict_types=1);


namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

class NewAction extends InfluencerProduct
{
    /**
     * New action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Forward $resultForwardFactory */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}

