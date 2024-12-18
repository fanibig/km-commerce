<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $pageTitle = "Dashboard";

        $chartData = [
            // 'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'labels' => ['Sales', 'Products'],
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => [55, 70],
                    // 'backgroundColor' => '#FF6384',
                    // 'borderColor' => '#FFB1C1',
                    // 'borderWidth' => 1,
                ]
            ],
        ];

        $chartOptions = [
            'responsive' => true,
            'maintainAspectRatio' => false,
            // 'scales' => [
            //     'y' => ['beginAtZero' => true]
            // ],
        ];

        return view('admin.dashboard', compact('pageTitle', 'chartData', 'chartOptions'));
    }
}