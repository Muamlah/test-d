<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\User;
use App\Http\Resources\Config\ConfigCollection;
use Illuminate\Support\Facades\Validator;

class ConfigsController extends Controller
{
    protected $data = [];

    public function __construct()
    {
 
    }
    public function index()
    {
        return view('admin.config.index', $this->data);
    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Config::query();

        if ( $request->input('query.generalSearch')!=null) {
            $query->where('name','like','%'.$request->input('query.generalSearch').'%')
                ->orWhere('key','like','%'.$request->input('query.generalSearch').'%')
                ->orWhere('val','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new ConfigCollection($data));
    }

    public function create()
    {
        return view('admin.config.create', $this->data);
    }
    public function edit(Config $config)
    {
        $this->data['config'] = $config;

        return view('admin.config.update', $this->data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>'required|string|max:255',
            'key'   =>'required|string|unique:web_config|max:255',
            'val'   =>'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Config::create($request->only(['name', 'key', 'val']));
        return redirect()->route('admin.config.create')->with("success","تم الانشاء بنجاح");
    }

    public function save(Request $request, Config $config)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>'required|string|max:255',
            'key'   =>'required|string|max:255|unique:web_config,key,'.$config->id,
            'val'   =>'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $config->update($request->only(['name', 'key', 'val']));

        return redirect()->route('admin.config.edit',['config' => $config->id])->with("success","تم التعديل بنجاح");
    }

    public function delete(Config $config)
    {
        $config->delete();
        return redirect()->route('admin.config.index');

    }
}
