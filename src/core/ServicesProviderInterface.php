<?php

namespace App\Core;

interface ServicesProviderInterface
{
    /**
     * Registers services in the container.
     *
     * @param Container $container
     * @param array $services
     * @return void
     */
    public function register(Container $container, array $services): void;
}
