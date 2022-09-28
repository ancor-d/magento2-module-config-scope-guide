<?php
declare(strict_types = 1);

/**
 * @package Asp\ConfigScopeGuide
 * @author Adam Sprada <adam.sprada@gmail.com>
 * @copyright 2020 Adam Sprada
 * @license See LICENSE for license details.
 */

namespace Asp\ConfigScopeGuide\Plugin;

use Magento\Config\Model\Config\Structure\Element\Field;

/**
 * Class ConfigGuidePlugin
 */
class ConfigGuidePlugin
{
    /**
     * Add config path to comment section.
     *
     * @param Field $subject
     * @param string $comment
     *
     * @return string
     */
    public function afterGetComment(Field $subject, string $comment): string
    {
        $path = $subject->getConfigPath() ?: $subject->getPath();
        $path = sprintf('<code>Path: %s</code>', $path);

        if (strlen(trim($comment))) {
            $path .= '<br />';
        }

        return $path . $comment;
    }
}
