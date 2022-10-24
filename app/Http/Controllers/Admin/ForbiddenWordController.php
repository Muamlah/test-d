<?php

namespace App\Http\Controllers\Admin;


use App\Http\Resources\ForbiddenWord\ForbiddenWordCollection;

use App\Models\eservices;
use App\Models\ForbiddenWord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\Resources\Json\ResourceCollection;




class ForbiddenWordController extends Controller
{
//    public function __construct()
//    {
//        // PREMISSIONS MIDDLEWARE
//        $this->middleware('permission:READ_ADMINS')->only('index');
//        $this->middleware('permission:CREATE_ADMINS')->only(['create', 'store']);
//        $this->middleware('permission:UPDATE_ADMINS')->only(['edit', 'update']);
//
//    }

    public function index(Request $request)
    {
        $items = ForbiddenWord::query()->orderBy('id', 'desc')->get();

        return view('admin.forbiddenWords.index',compact('items'));
    }

    public function create()
    {
        return view('admin.forbiddenWords.create');
    }
    public function store(Request $request)
    {

        $word = New ForbiddenWord();
        $word->name=$request->name;
        $word->description=$request->description;
        $word->save();

        //  return redirect()->route('admin.forbiddenWords.index')->with('status', __('common.create'));
        return redirect()->back()->with('success', __('common.success_add'));
    }

    public function edit($id)
    {
        $item = ForbiddenWord::query()->find($id);
        return view('admin.forbiddenWords.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id) {
        $data = $request->all() ;

        $item = ForbiddenWord::query()->find($id);
        $item->update($data);

        return redirect()->back()->with('success', __('common.success_edit'));
    }

    public function get_all(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = ForbiddenWord::query();
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('name',$request->input('query.generalSearch'));
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new ForbiddenWordCollection($data));
    }

    public function destroy($id){

        ForbiddenWord::find($id)->delete($id);

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }



}
