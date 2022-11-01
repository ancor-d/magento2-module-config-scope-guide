<?php

declare(strict_types = 1);

namespace Asp\ConfigScopeGuide\Test\Unit\Plugin;

use Magento\Config\Model\Config\Structure\Element\Field as Subject;
use Asp\ConfigScopeGuide\Plugin\ConfigGuidePlugin as Plugin;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Provides tests for @see \Asp\ConfigScopeGuide\Plugin\ConfigGuidePlugin
 */
class ConfigGuidePluginTest extends TestCase
{
    /**
     * @var Plugin|MockObject
     */
    private $plugin;

    /**
     * @var Subject|MockObject
     */
    private $subjectMock;

    private const PATH = 'general/country/default';
    private const SCOPE = 'default';

    public function testCommentIsPresent(): void
    {
        $comment = 'comment';

        $expectedResult = sprintf('<code>Path: %s</code>', self::PATH) . '<br />' . $comment;
        $this->subjectMock->setData(['path' => self::PATH], self::SCOPE);
        $this->subjectMock->expects(self::once())
            ->method('getConfigPath')
            ->willReturn(self::PATH);

        self::assertEquals($expectedResult, $this->plugin->afterGetComment($this->subjectMock, $comment));
    }

    public function testCommentNotPresent(): void
    {
        $expectedResult = sprintf('<code>Path: %s</code>', self::PATH) ;
        $this->subjectMock->setData(['path' => self::PATH], self::SCOPE);
        $this->subjectMock->expects(self::once())
            ->method('getConfigPath')
            ->willReturn(self::PATH);

        self::assertEquals($expectedResult, $this->plugin->afterGetComment($this->subjectMock, ''));
    }

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);

        $this->plugin = $objectManager->getObject(Plugin::class);

        $this->subjectMock = $this->getMockBuilder(Subject::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
