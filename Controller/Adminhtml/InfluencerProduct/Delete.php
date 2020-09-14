<?php declare(strict_types=1);


namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

class Delete extends InfluencerProduct
{
    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $influencer = $this->influencerProductRepository->get($id);
                $this->influencerProductRepository->delete($influencer);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted Influencer Product id: %1.', $id));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Influencer Product to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

