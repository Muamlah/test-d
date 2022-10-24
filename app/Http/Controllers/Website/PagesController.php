<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['categories'] = Page::getCategories();
        $this->data['pages'] = Page::where('base_type', 'page')->get();
        return view('website.pages.index', $this->data);
    }
    public function manual()
    {
        $this->data['pages'] = Page::where('base_type', 'page')->get();
        return view('website.pages.manual', $this->data);
    }

    public function details(Page $page)
    {
        $this->data['page'] = $page;
        return view('website.pages.details', $this->data);
    }

    public function updates()
    {
        $this->data['pages'] = Page::where('base_type', 'update')->get();
        return view('website.pages.updates', $this->data);
    }

    public function thanks()
    {
        return view('website.pages.thanks');
    }


}
