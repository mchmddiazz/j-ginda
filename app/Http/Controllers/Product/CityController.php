<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\ProvinceSecond;
use App\Models\CitySecond;
class CityController extends Controller
{
    public function getKabupaten($id)
    {
        $data = CitySecond::where('province_id', $id)->pluck('name', 'city_id');

        $res = '<option value="" selected>Pilih Salah Satu</option>';
        foreach ($data as $city => $value) {
            $res .= '<option value="'.$city.'">'.$value.'</option>';
        }
        return response()->json(['res' => $res], 201);
    }

}
