<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class AboutUsController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {
            $data = AboutUs::orderBy('id', 'DESC')
            ->where('status', 1)
            ->get();
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="#" class="btn btn-info" data-id="'.$data->id.'" data-bs-toggle="modal" data-bs-target="#modelId" id="buton_edit"><i class="fa-solid fa-edit me-2"></i> Edit</a> '.
                    '<a href="#" class="btn btn-danger" data-id="'.$data->id.'" id="buton_hapus"><i class="fa-solid fa-trash me-2"></i> Hapus</a>';
                })
                ->addColumn('image', function($data){
                    return '<img src="'.asset('about/', $data->image).'" alt="Site Logo" style="height: 95px;">';
                })
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.aboutus.index');
    }

    function store(Request $request)
    {
		date_default_timezone_set('Asia/Jakarta');

        request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $about_id = $request->about_id;
        $details = [
            'name'          => $request->name,
            'description'   => $request->description,
            'address'       => $request->address,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'status'        => 1
        ];

        if ($files = $request->file('image')) {
            //delete old file
            \File::delete('public/about/'.$request->hidden_image);
          
            //insert new file
            $destinationPath = 'public/about/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $details['image'] = "$profileImage";
         }
         $AboutUs   =   AboutUs::updateOrCreate(['id' => $about_id], $details);  
           
         return response()->json($AboutUs);
    }

    function edit($id)
    {
        $where = array('id' => $id);
        $AboutUs  = AboutUs::where($where)->first();
    
        return response()->json($AboutUs);
    }

    function destroy($id)
    {
        $data = AboutUs::where('id',$id)->first(['image']);
        \File::delete('public/about/'.$data->image);
       
        $AboutUs = AboutUs::where('id', $id)->first();
        $AboutUs->status = 0;
        $AboutUs->save();
    
        return response()->json($AboutUs);
    }
}
