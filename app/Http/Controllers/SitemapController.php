<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{eservices, User};


class SitemapController extends Controller
{
    public function index(){
        $pages = [];
        $pages[] = '/eservices/maps/sitemap.xml';
        $pages[] = '/providers/maps/sitemap.xml';
        return response()->view('website.sitemap.index', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }

    public function eservices_sitemap(){
        $eservices = eservices::get();
        return response()->view('website.sitemap.eservices', [
            'contents' => $eservices,
        ])->header('Content-Type', 'text/xml');
    }
    public function providers_sitemap(){
        $providers = User::where('level', 'provider')->get();
        return response()->view('website.sitemap.providers', [
            'contents' => $providers,
        ])->header('Content-Type', 'text/xml');
    }
}
