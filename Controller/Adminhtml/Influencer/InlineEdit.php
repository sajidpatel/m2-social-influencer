<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultInterface;
use SajidPatel\SocialInfluencer\Controller\Adminhtml\Influencer;

class InlineEdit extends Influencer
{
    /**
     * Inline edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    /** @var Influencer $model */
                    $influencer = $this->influencerRepository->get($modelid);
                    try {
                        $influencerData = $this->dataObjectConverter->toFlatArray($influencer);
                        $influencer->setData(array_merge($influencerData, $postItems[$modelid]));
                        $influencer->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Influencer ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

