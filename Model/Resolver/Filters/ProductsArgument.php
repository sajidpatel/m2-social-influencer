<?php declare(strict_types=1);

namespace SajidPatel\SocialInfluencer\Model\Resolver\Filters;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\Argument\FieldEntityAttributesInterface;
use Magento\Framework\GraphQl\ConfigInterface;

/**
 * Class ProductsArgument
 * @package SajidPatel\SocialInfluencer\Model\Resolver\Filters
 */
class ProductsArgument implements FieldEntityAttributesInterface
{
    /** @var ConfigInterface */
    private $config;

    /**
     * FilterArgument constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }
    /**
     * Get the attributes for an entity
     *
     * @return array
     */
    public function getEntityAttributes(): array
    {
        $fields = [];
        /** @var Field $field */
        foreach ($this->config->getConfigElement('InfluencerProduct')->getFields() as $field) {
            $fields[$field->getName()] = 'String';
        }
        return $fields;
    }
}
