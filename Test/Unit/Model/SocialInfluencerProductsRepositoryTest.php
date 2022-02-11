<?php declare(strict_types = 1);

namespace SajidPatel\SocialInfluencer\Model;

use PHPUnit\Framework\TestCase;
use SajidPatel\SocialInfluencer\Api\SocialInfluencerProductsSessionRepositoryInterface;

/**
 * @covers \SajidPatel\SocialInfluencer\Model\SocialInfluencerProductsSessionRepositoryTest
 */
class SocialInfluencerProductsSessionRepositoryTest extends TestCase
{
    /**
     * @var SocialInfluencerProductsSession|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockSession;

    private function createRepository(): SocialInfluencerProductsSessionRepository
    {
        return new SocialInfluencerProductsSessionRepository($this->mockSession);
    }

    protected function setUp()
    {
        $this->mockSession = $this->getMockBuilder(SocialInfluencerProductsSession::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testImplementsSocialInfluencerProductsSessionRepositoryInterface()
    {
        $this->assertInstanceOf(SocialInfluencerProductsSessionRepositoryInterface::class, $this->createRepository());
    }

    public function testReturnsTheSkusStoredInTheSession()
    {
        $productsSkus = ['foo', 'bar', 'baz'];
        $this->mockSession->method('getSocialInfluencerProducts')->willReturn($productsSkus);
        $this->assertSame($productsSkus, $this->createRepository()->getSkus());
    }

    public function testAddsSkuToSession()
    {
        $this->mockSession->expects($this->once())->method('addSocialInfluencerProduct')->with('foo');
        $this->createRepository()->addBySku('foo');
    }

    public function testRemovesSkuFromSession()
    {
        $this->mockSession->expects($this->once())->method('removeSocialInfluencerProductSku')->with('bar');
        $this->createRepository()->removeBySku('bar');
    }
}
