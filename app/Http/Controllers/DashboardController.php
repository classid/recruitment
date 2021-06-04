<?php

namespace App\Http\Controllers;

use Dentro\Yalr\Attributes\Get;
use Dentro\Yalr\Attributes\Middleware;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

#[Middleware(['auth:sanctum', 'verified'])]
class DashboardController extends Controller
{
    #[Get('dashboard', name: 'dashboard')]
    public function index(): InertiaResponse
    {
        return Inertia::render('Dashboard');
    }
}
