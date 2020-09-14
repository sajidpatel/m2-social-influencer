<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

class Save extends Influencer
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
            $influencerResource = $this->influencerFactory->create();
            $influencer = $influencerResource->load($id);

            if (!$influencer->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Influencer no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            $influencer->setData($data);

            try {
                $influencer->save();
                $this->messageManager->addSuccessMessage(__('You saved the Influencer.'));
                //$this->dataPersistor->clear('social_influencer');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Influencer.'));
            }

            //$this->dataPersistor->set('social_influencer', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

