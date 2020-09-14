<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Product\AwareInterface as ProductAwareInterface;
use Magento\Framework\UrlInterface as UrlBuilder;
use Magento\Framework\View\Element\Template;

class AddToCollection extends Template implements ProductAwareInterface
{
    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->urlBuilder = $context->getUrlBuilder();
        $this->setTemplate('SajidPatel_SocialInfluencer::list/add-to-collection.phtml');
    }

    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
        return $this;
    }

    public function getProductSku()
    {
        return $this->product->getSku();
    }

    public function getApiUpdateUrl()
    {
        return $this->urlBuilder->getDirectUrl('rest/V1/socialinfluencer/products/');
    }
}
