<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUs\StoreAboutUsRequest;
use App\Services\Admin\AboutUsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class AboutUsController extends Controller
{
    /**
     * @param AboutUsService $service
     * @param Request $request
     * @return Response
     */
    public function index(AboutUsService $service):Response
    {
        $response = $service->getAllData();
        viewShare($response);
        return response()->view('admin.about-us.index');
    }


    /**
     * @param AboutUsService $service
     * @return Response
     */
    public function create(AboutUsService $service):Response
    {
        $response = $service->getCreateData();

        viewShare($response);
        return response()->view('admin.about-us.create');
    }


    /**
     * @param AboutUsService $service
     * @return RedirectResponse
     */
    public function store(AboutUsService $service, StoreAboutUsRequest $request):RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.about.us.store")->with("success", ucfirst("Tambah data about us berhasil !"));
    }


    function store2(Request $request)
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
