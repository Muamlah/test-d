<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\Update;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Resources\Pages\PageCollection;

class PagesController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        $this->middleware('canPermission:READ_PAGES');
       
    }
    public function index()
    {
        return view('admin.pages.index', $this->data);
    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Page::where('base_type', $request->base_type);
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('details','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new PageCollection($data));
    }
    public function create()
    {
        $this->data['categories'] = Page::getCategories();
        $this->data['types'] = Page::getTypes();
        return view('admin.pages.create', $this->data);
    }
    public function edit(Page $page)
    {
        $this->data['page'] = $page;
        $this->data['categories'] = Page::getCategories();
        $this->data['types'] = Page::getTypes();
        return view('admin.pages.update', $this->data);

    }

    public function store(Update $request, Page $page)
    {
        $page->create($request->only(['title', 'details', 'category', 'type', 'base_type']));
        return redirect()->route('admin.pages.index', ['base_type' => $request->base_type])->with("success","تم الإضافة بنجاح");
    }

    public function save(Update $request, Page $page)
    {
        $page->update($request->only(['title', 'details', 'category', 'type']));
        return redirect()->route('admin.pages.edit',['page' => $page->id])->with("success","تم التعديل بنجاح");
    }

    public function delete(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index');

    }

}
