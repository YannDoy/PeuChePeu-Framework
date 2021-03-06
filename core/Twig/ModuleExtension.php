<?php

namespace Core\Twig;

use DI\Container;

/**
 * Permet de rajouter la fonction module_enabled() à Twig.
 */
class ModuleExtension extends \Twig_Extension
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('has_module', [$this, 'hasModule'])
        ];
    }

    public function hasModule(string $moduleName): bool
    {
        $moduleName = ucfirst($moduleName);

        return $this->container->has("App\\{$moduleName}\\{$moduleName}Module");
    }
}
