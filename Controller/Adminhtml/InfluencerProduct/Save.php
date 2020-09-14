<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\InfluencerProduct;

class Save extends InfluencerProduct
{
    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            $model = $this->influencerProductFactory->create()->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Influencer Product no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            try {
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Influencer Product.'));
                //$this->dataPersistor->clear('social_influencer_product');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Influencer Product.'));
            }

            //$this->dataPersistor->set('social_influencer_product', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

