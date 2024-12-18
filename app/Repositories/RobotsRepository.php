<?php

namespace App\Repositories;

use Spatie\Robots\RobotsTxt;
use App\Contracts\RobotsRepositoryInterface;

class RobotsRepository implements RobotsRepositoryInterface
{
    protected array $rules = [];

    public function allow(string $userAgent, string $path = '/'): void
    {
        $this->rules[$userAgent][] = "Allow: $path";
    }

    public function disallow(string $userAgent, string $path = '/'): void
    {
        $this->rules[$userAgent][] = "Disallow: $path";
    }

    public function generateRobotsTxt(): string
    {
        $content = '';

        foreach ($this->rules as $userAgent => $rules) {
            $content .= "User-agent: $userAgent\n";
            foreach ($rules as $rule) {
                $content .= "$rule\n";
            }
            $content .= "\n";
        }

        return $content;
    }
}