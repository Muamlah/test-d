<?php

namespace App\Http\Controllers\Website;


use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class HomeController extends Controller
{

    /**
     * @return View
     */
    public function index ():View
    {
        $data['meta_title'] = "منصة معاملة . كوم";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.home', $data);
    }
    /**
     * @return View
     */
    public function provider ():View
    {
        $data['meta_title'] = "منصة معاملة . كوم";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.provider', $data);
    }
    /**
     * @return View
     */
    public function affiliate ():View
    {
        $data['meta_title'] = "منصة معاملة . كوم";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.affiliate', $data);
    }
    /**
     * @return View
     */
    public function customers ():View
    {
        $data['meta_title'] = "منصة معاملة ";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.customers', $data);
    }
    /**
     * @return View
     */
    public function pricing ():View
    {
        $data['meta_title'] = "منصة معاملة . كوم";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.pricing', $data);
    }
    /**
     * @return View
     */
    public function odoo ()
    {
        $odoo = new \Obuchmann\LaravelOdooApi\Odoo();

        $version = $odoo->version();
        dd($version);

    }
    /**
     * @return View
     */
    public function agent ():View
    {
        $data['meta_title'] = "منصة معاملة . كوم";
        $data['meta_description'] = "منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية .";
        $data['meta_image'] = asset("/template-muamlah/images/logo.png");
        return view ('website.agent', $data);
    }
    /**
     * @return View
     */
    public function supervisorGuide ():View
    {
        return view ('website.supervisor_guide');
    }
    /**
     * @return View
     */
    public function customerGuide ():View
    {
        return view ('website.customer_guide');
    }
}
