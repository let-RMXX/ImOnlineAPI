<?php

namespace App\Http\Controllers\api;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserInfoController extends Controller
{
    public function index()
    {
        $usersinfo = UserInfo::all();
        if ($usersinfo->count() > 0) {

            return response()->json([
                'status' => 200,
                'usersinfo' => $usersinfo
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $usersinfo = UserInfo::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if ($usersinfo) {
                return response()->json([
                    'status' => 200,
                    'message' => "User Created Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $usersinfo = UserInfo::find($id);
        if ($usersinfo) {
            return response()->json([
                'status' => 200,
                'usersinfo' => $usersinfo
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No User Found"
            ], 404);
        }
    }

    public function edit($id) 
    {
        $usersinfo = UserInfo::find($id);
        if ($usersinfo) {
            return response()->json([
                'status' => 200,
                'usersinfo' => $usersinfo
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No User Found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $usersinfo = UserInfo::find($id);
            if ($usersinfo) {
                
                $usersinfo->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "User updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No User Found"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $usersinfo = UserInfo::find($id);
        if ($usersinfo) {

            $usersinfo->delete();
            return response()->json([
                'status' => 200,
                'message' => "User Deleted Successfully"
            ], 200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No User Found"
            ], 404);
        }
    }
}
