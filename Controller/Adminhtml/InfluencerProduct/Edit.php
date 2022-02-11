<?php declare(strict_types=1);


namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

class Edit extends InfluencerProduct
{
    /**
     * Edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $influencerProduct = null;
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        // 2. Initial checking
        if ($id) {
            try {
                $influencerProduct = $this->influencerProductRepository->get($id);
            } catch (LocalizedException $e) {
                return $this->returnToListingPage();
            }
            //$this->dataPersistor->set('social_influencer_product', $influencerProduct);
        }

        // 3. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Influencer Product') : __('New Influencer Product'),
            $id ? __('Edit Influencer Product') : __('New Influencer Product')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Influencer Products'));
        if ($influencerProduct) {
            $resultPage->getConfig()->getTitle()->prepend($influencerProduct->getId() ? __('Edit Influencer Product %1', $influencerProduct->getId()) : __('New Influencer Product'));
        }
        return $resultPage;
    }

    /**
     * @return Redirect
     */
    protected function returnToListingPage(): Redirect
    {
        $this->messageManager->addErrorMessage(__('This Influencer Product no longer exists.'));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}

