<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RegistratModel extends Model
{
    public function getCountMembers()
    {
        $count = DB::table('user')->where('user_hidden', 0)->count();
        return $count;
    }

    public function addUser($data)
    {
        $id = DB::table('user')->insertGetId($data);

        if ($id > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($data)
    {
        $res = DB::table('user')->where('email', $data['email'])->update($data); // return '0' if not update any single row

        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function similarEmail($email)  // проверка на схожесть email
    {
        $user = DB::table('user')->where('email', $email)->first();  // return 'null' if not found email

        if ($user != null) {
            return true;
        } else {
            return false;
        }
    }

    public function updateHiddenMember($data)
    {
        $res = DB::table('user')->where('id', $data['id'])->update(['user_hidden' => $data['user_hidden']]); // return '0' if not update any single row

        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }
}
