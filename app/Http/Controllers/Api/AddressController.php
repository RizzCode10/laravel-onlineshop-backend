<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        // Membuat variabel untuk memanggil id user
        $user_id = $request->user()->id;
        //address by user id
        $addresses = DB::table('addresses')->where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'Success',
            'data' => $addresses,
            'user_id' => $user_id
        ]);

    }

    public function store(Request $request)
    {
        $address = DB::table('addresses')->insert([
            'street' => $request->street,
            'full_address' => $request->full_address,
            'phone' => $request->phone,
            'prov_id' => $request->prov_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user()->id,
            'is_default' => $request->is_default,
        ]);
        // return response()->json([
        //     'status' => 'Success',
        //     'data' => $address
        // ]);
        if ($address) {
            return response()->json([
                'status' => 'Success',
                'data' => $address
            ]);
        }else{
            return response()->json([
                'status' => 'Failed',
                'data' => $address
            ]);
        }
    }
}
