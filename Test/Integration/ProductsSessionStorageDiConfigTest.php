<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer;

use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\Framework\Session\Storage as SessionStorage;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;
use SajidPatel\SocialInfluencer\Model\SocialInfluencerProductsSession;

class ProductsSessionStorageDiConfigTest extends TestCase
{
    private $storageVirtualType = Model\ProductsSessionStorage\Virtual::class;

    private function getDiConfiguration(): ObjectManagerConfig
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }

    public function testImplementsSessionStorage()
    {
        $diConfig = $this->getDiConfiguration();
        $this->assertSame(SessionStorage::class, $diConfig->getInstanceType($this->storageVirtualType));
    }

    public function testSessionNamespaceIsSet()
    {
        $arguments = $this->getDiConfiguration()->getArguments($this->storageVirtualType);
        $this->assertSame('social_influencer_products', $arguments['namespace']);
    }

    public function testVirtualTypeIsConfiguredAsStorageForProductsSession()
    {
        $diConfig = $this->getDiConfiguration()->getArguments(SocialInfluencerProductsSession::class);
        $this->assertSame($this->storageVirtualType, $diConfig['storage']['instance']);

    }
}
