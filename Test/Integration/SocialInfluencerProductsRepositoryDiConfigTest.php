<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer;

use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class SocialInfluencerProductsSessionRepositoryDiConfigTest extends TestCase
{
    private $instanceType = Api\SocialInfluencerProductsSessionRepositoryInterface::class;

    private function getDiConfiguration(): ObjectManagerConfig
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }

    public function testPreference()
    {
        $this->assertSame(Model\SocialInfluencerProductsSessionRepository::class, $this->getDiConfiguration()->getPreference($this->instanceType));
    }
}
