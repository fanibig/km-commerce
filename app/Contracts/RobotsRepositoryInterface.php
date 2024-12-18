<?php

namespace App\Contracts;

interface RobotsRepositoryInterface
{
    public function allow(string $userAgent, string $path = '/'): void;
    public function disallow(string $userAgent, string $path = '/'): void;
    public function generateRobotsTxt(): string;
}