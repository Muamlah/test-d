<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\eservices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\SectionsCollection;
use App\Traits\CommonTrait;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE

        $this->middleware('auth:admin');
        $this->middleware('permission:READ_SECTIONS', ['only' => ['list']]);
        $this->middleware('permission:CREATE_SECTIONS', ['only' => ['create', 'store']]);
        $this->middleware('permission:UPDATE_SECTIONS', ['only' => ['edit', 'update']]);
    }

    // $eservices = eservices::where('section_id', $section->id)->count();

    // if ($eservices > 0) {
    //     return redirect('/admin/sections/list')->with('message', 'الرجاء حذف كل الخدمات بداخل القسم ثم حذف القسم');
    // } else {
    //     $section->delete();
    //     return redirect('/admin/sections/list');
    // }
        
    public function delete($id)
    {

        $eservices          = eservices::where('section_id', $id)->count();

        if ($eservices > 0) {
            
            return redirect('/admin/sections/list')->with('message', 'الرجاء حذف كل الخدمات بداخل القسم ثم حذف القسم');
        } else {
            
            $section        = sections::findOrFail($id);
            $description    = ' تم حذف خدمة باسم  '.$section->name.' ';
            $this->addLog('حذف خدمة ',$description);

            $section->delete();
            return redirect('/admin/sections/list');
        }

    }
    public function list()
    {
        // $sections = sections::all();
        return view('admin.sections.list');
    }
    public function get_all(Request $request) {
        $page           = $request->input('pagination.page','1');
        $search         = $request->input('query.generalSearch',null);
        $perpage        = $request->input('pagination.perpage',10);
        $sortOrder      = $request->input('sort.sort','asc');
        $sortField      = $request->input('sort.field','id');
        $offset         = ($page - 1) * $perpage;
        $query          = sections::query();
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('name','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new SectionsCollection($data));
    }

    public function details($id)
    {

        $sections = sections::findorfail($id);
        return view('admin/sections/details', compact('sections'));
    }

    public function create()
    {

        return view('admin.sections.create');
    }


    public function store()
    {

        $section = sections::create($this->validateData()); // insert
        $this->storeImage($section);
        return redirect('/admin/sections/create')->with("success", "Created Successfully"); // send id of inserted

    }


    public function edit(sections $section)
    {

        return view('admin.sections.edit', compact('section'));
    }


    public function update(Request $request, sections $section)
    {

        $section->update($this->validateData());
        $this->storeImage($section);
        return redirect('/admin/sections/' . $section->id . "/edit")->with('success', 'successfully updated');
    }


    // public function destroy(sections $section)
    // {

    //     $eservices = eservices::where('section_id', $section->id)->count();

    //     if ($eservices > 0) {
    //         return redirect('/admin/sections/list')->with('message', 'الرجاء حذف كل الخدمات بداخل القسم ثم حذف القسم');
    //     } else {
    //         $section->delete();
    //         return redirect('/admin/sections/list');
    //     }
    // }




    private function storeImage($section)
    {


        if (request()->hasFile('img')) {

            $file = request()->file('img');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/storage/uploads';
            $uplaod = $file->move($path, $fileName);

            $section->img = 'uploads/' . $fileName;
            $section->save();

            /*  $section->update([


            'img'=>request()->img->store('uploads','public')



            ]); */
        }
    }



    protected function validateData()
    {


        $mydata =  [
            'name' => 'required',
        ];

        if (request()->hasFile('img')) {
            $mydata['img'] = 'file|image';
        }

        $validatedData = request()->validate($mydata);



        return $validatedData;
    }
}
