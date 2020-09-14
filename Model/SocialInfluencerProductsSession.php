<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\Model;

use Magento\Framework\Session\SessionManager;
use Magento\Framework\Session\Storage;
use SajidPatel\SocialInfluencer\Model\Exception\InvalidProductSkuException;

class SocialInfluencerProductsSession extends SessionManager
{
    const STORAGE_KEY = 'social_influencer_products';

    /**
     * @return string[]
     */
    public function getSocialInfluencerProducts()
    {
        return array_values($this->getSocialInfluencerProductsData());
    }

    /**
     * @param string $sku
     */
    public function addSocialInfluencerProduct($sku)
    {
        $this->validateSku($sku);
        $products = $this->getSocialInfluencerProductsData();

        if (!in_array($sku, $products, true)) {
            $products[] = $sku;
            $this->setSocialInfluencerProductsData($products);
        }
    }

    /**
     * @param string $sku
     */
    public function removeSocialInfluencerProductSku($sku)
    {
        $products = $this->getSocialInfluencerProductsData();
        $key = array_search($sku, $products, true);
        if (false !== $key) {
            unset($products[$key]);
            $this->setSocialInfluencerProductsData($products);
        }
    }

    private function validateSku($sku)
    {
        if (!is_string($sku)) {
            $message = sprintf('Product SKUs have to be strings, got %s', gettype($sku));
            throw new InvalidProductSkuException($message);
        }
        if (empty(trim($sku))) {
            throw new InvalidProductSkuException('Product SKUs must not be empty');
        }
    }

    private function getSocialInfluencerProductsData(): array
    {
        return (array) $this->getSessionStorage()->getData(self::STORAGE_KEY);
    }

    private function setSocialInfluencerProductsData(array $products)
    {
        $this->getSessionStorage()->setData(self::STORAGE_KEY, $products);
    }

    /**
     * This is ugly AF!
     * But still less coupling than overriding the constructor and having to get the storage from the context.
     * Another issue is that the Session\StorageInterface does not have a getData() method.
     */
    private function getSessionStorage(): Storage
    {
        /** @var Storage $storage */
        $storage = $this->storage;
        return $storage;
    }
}
