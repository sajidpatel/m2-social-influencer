<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SajidPatel\SocialInfluencer\Model\CreateInfluencer as CreateInfluencerService;

class CreateInfluencer implements ResolverInterface
{
    /**
     * @var CreateInfluencerService
     */
    private $createInfluencer;

    /**
     * @param CreateInfluencerService $createInfluencer
     */
    public function __construct(CreateInfluencerService $createInfluencer)
    {
        $this->createInfluencer = $createInfluencer;
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
            $influencer = $this->createInfluencer->execute($args['input']);
            if ($influencer->getId()) {
                return ['message'=>'Influencer Successfully Saved.', 'id' => $influencer->getId()];
            } else {
                return ['message'=>'Unable to save the Influencer.'];
            }
        } catch (LocalizedException $e) {
            return ['message'=> __($e->getMessage())];
        }
    }
}
