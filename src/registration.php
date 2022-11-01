<?php
/**
 * @package Asp\ConfigScopeGuide
 * @author Adam Sprada <adam.sprada@gmail.com>
 * @copyright 2020 Adam Sprada
 * @license See LICENSE for license details.
 */

declare(strict_types = 1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Asp_ConfigScopeGuide',
    __DIR__
);
