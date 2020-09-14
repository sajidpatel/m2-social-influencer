<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

class Index extends Influencer
{
    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Influencer"));
        return $resultPage;
    }
}
