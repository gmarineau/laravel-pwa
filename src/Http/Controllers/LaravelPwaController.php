<?php

namespace GMarineau\LaravelPwa\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelPWA\Services\ManifestService;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class LaravelPwaController extends Controller
{
    public function manifestJson(): JsonResponse
    {
        $output = (new ManifestService())->generate();

        return response()->json($output);
    }

    public function offline(): View
    {
        return view('laravelpwa::offline');
    }
}
