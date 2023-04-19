<?php

namespace SDPMlab\Anser\Discovery;

interface DiscoverInterface
{
    public function getDiscoverServiceList(): array;

    public function getDiscoverServiceNode(string $serviceName): array;

    public function updateDiscoverServicesList(): void;

    public function clearDiscoverServicesList(): void;
}
