<?php
declare(strict_types=1);
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Convenient_Example', __DIR__);

if (PHP_SAPI === 'cli') {
    \Magento\Framework\Console\CommandLocator::register(
        \Convenient\Example\Console\CommandList::class
    );
}
