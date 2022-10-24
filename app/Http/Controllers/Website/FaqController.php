<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\Store;
use App\Http\Requests\Admin\Faq\update;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Resources\Faq\FaqCollection;

class FaqController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['faqs'] = Faq::get();
        $this->data['types'] = Faq::getTypes();
        return view('website.faqs.index', $this->data);
    }


}
