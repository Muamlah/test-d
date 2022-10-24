<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\Store;
use App\Http\Requests\Admin\Faq\Update;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Resources\Faq\FaqCollection;

/**
 * Class FaqController
 * @package App\Http\Controllers\Admin
 */
class FaqController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        $this->middleware('canPermission:READ_FAQ');
 
    }
    public function index()
    {
        return view('admin.faq.index', $this->data);
    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Faq::query();
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('question','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new FaqCollection($data));
    }
    public function create()
    {
        $this->data['types'] = Faq::getTypes();
        return view('admin.faq.create', $this->data);

    }
    public function edit(Faq $faq)
    {
        $this->data['faq'] = $faq;
        $this->data['types'] = Faq::getTypes();
        return view('admin.faq.update', $this->data);

    }
    public function store(Store $request)
    {
        Faq::create($request->only(['question', 'answer', 'type']));
        return redirect()->route('admin.faq.create')->with("success","تم الانشاء بنجاح");
    }

    public function save(Update $request, Faq $faq)
    {
        $faq->update($request->only(['question', 'answer', 'type']));
        return redirect()->route('admin.faq.edit',['faq' => $faq->id])->with("success","تم التعديل بنجاح");
    }

    public function delete(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index');

    }

}
