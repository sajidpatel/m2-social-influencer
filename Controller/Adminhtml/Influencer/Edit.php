<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

class Edit extends Influencer
{
    /**
     * @return Page|Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $influencer = null;
        // 2. Initial checking
        if ($id) {
            $influencer = $this->influencerRepository->get($id);
            if (!$influencer->getId()) {
                $this->messageManager->addErrorMessage(__('This Influencer no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
            //$this->dataPersistor->set('social_influencer', $influencer);
        }

        // 3. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Influencer') : __('New Influencer'),
            $id ? __('Edit Influencer') : __('New Influencer')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Influencers'));

        if ($influencer) {
            $resultPage->getConfig()->getTitle()->prepend($influencer->getId() ? __('Edit Influencer %1', $influencer->getSocialName()) : __('New Influencer'));
        }

        return $resultPage;
    }
}
