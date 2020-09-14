<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SajidPatel\SocialInfluencer\Model\CreateInfluencerProduct as CreateInfluencerProductService;

class CreateInfluencerProduct implements ResolverInterface
{
    /**
     * @var CreateInfluencerProductService
     */
    private $createInfluencerProduct;

    /**
     * @param CreateInfluencerProductService $createInfluencerProduct
     */
    public function __construct(CreateInfluencerProductService $createInfluencerProduct)
    {
        $this->createInfluencerProduct = $createInfluencerProduct;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (empty($args['input']) || !is_array($args['input'])) {
            throw new GraphQlInputException(__('"input" value should be specified'));
        }
        try {
            $influencerProduct = $this->createInfluencerProduct->execute($args['input']);
            if ($influencerProduct->getId()) {
                return ['message'=>'Influencer Product Successfully Saved', 'id' => $influencerProduct->getId()];
            } else {
                return ['message'=>'Unable To save the Influencer Product.'];
            }
        } catch (LocalizedException $e) {
            return ['message'=> __($e->getMessage())];
        }
    }
}
