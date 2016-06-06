<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistratModel as RM;
use Response;
use App\Http\Requests;

class AdminController extends Controller
{
    public function HiddenMember(Request $request)
    {
        $model = new RM;

        $input = $request->input('id');

        $data_arr = [
            'id'          => $request->input('id'),
            'user_hidden' => $request->input('user_hidden')
        ];

        $resultOk = $model->updateHiddenMember($data_arr);

        return Response::json($resultOk);
    }
}
