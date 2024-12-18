<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\RobotsRepositoryInterface;

class RobotsController extends Controller
{
    protected $robotRepository;

    public function __construct(RobotsRepositoryInterface $robotRepository)
    {
        $this->robotRepository = $robotRepository;
    }

    public function generate()
    {
        // Define rules
        $this->robotRepository->allow('*', '/');
        $this->robotRepository->disallow('*', '/admin');

        // Generate the robots.txt content
        $robotsTxtContent = $this->robotRepository->generateRobotsTxt();

        return response($robotsTxtContent, 200, ['Content-Type' => 'text/plain']);
    }
}