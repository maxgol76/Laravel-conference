<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class ListModel extends Model
{
    public function showList()
    {
        $fieldsSelect = ['photo', 'fname', 'sname', 'report_subj', 'email', 'user_hidden', 'id'];

        $users = DB::table('user')->select($fieldsSelect)->get();

        return $users;
    }
}
