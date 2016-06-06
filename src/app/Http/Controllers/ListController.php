<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ListModel as LM;

class ListController extends Controller
{
    public function show()
    {
        $model = new LM;
        $data['title'] = 'List members';
        $data['users'] = $model->showList();   //LM::all();

        return view('pages.list', $data);
    }
}
