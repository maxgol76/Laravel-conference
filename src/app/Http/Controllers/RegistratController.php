<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\RegistratModel as RM;
use Response;
use Illuminate\Support\Facades\Config;

class RegistratController extends Controller
{
    public function form()
    {
        $model = new RM;

        $data['title'] = 'Registration';
        $data['countMembers'] = $model->getCountMembers();
        $data['url'] = Config::get('custom.siteName');
        $data['twitterTitle'] = Config::get('custom.twitterTitle');

        return view('pages.RegistrformView', $data);
    }

    public function validat(Request $request)
    {
        $model = new RM;

        $input = $request->all();

        $msgContainer = [];

        $fname = $this->cleanData($input['fname']);
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
        if (!empty($fname)) {
            if (!$this->okCheckLenght($fname, 1, 50)) {
                $msgContainer['fname'] = 'First Name can have from 1 to 50 letters!';
            }
        } else {
            $msgContainer['fname'] = 'First Name field cannot be empty!';
        }

        $sname = $this->cleanData($input['sname']);
        $sname = filter_var($sname, FILTER_SANITIZE_STRING);
        if (!empty($sname)) {
            if (!$this->okCheckLenght($sname, 1, 50)) {
                $msgContainer['sname'] = 'Last Name can have from 1 to 50 letters!';
            }
        } else {
            $msgContainer['sname'] = 'Last Name field cannot be empty!';
        }

        $birthday = $this->cleanData($input['birthday']);
        $birthday = filter_var($birthday, FILTER_SANITIZE_STRING);
        if (!preg_match('~(\d{4}\-\d{2}\-\d{2})+~', $birthday)) {
            $msgContainer['birthday'] = 'Birthday is not correct!';
        }

        $report_subj = $this->cleanData($input['reportsubj']);
        $report_subj = filter_var($report_subj, FILTER_SANITIZE_STRING);
        if (!empty($report_subj)) {
            if (!$this->okCheckLenght($report_subj, 1, 100)) {
                $msgContainer['reportsubj'] = 'Report subject can have from 1 to 100 letters!';
            }
        } else {
            $msgContainer['reportsubj'] = 'Report subject field cannot be empty!';
        }

        $country = $this->cleanData($input['country']);
        $country = filter_var($country, FILTER_SANITIZE_STRING);
        if (!empty($country)) {
            if (!$this->okCheckLenght($country, 1, 50)) {
                $msgContainer['country'] = 'Country can have from 1 to 50 letters!';
            }
        } else {
            $msgContainer['country'] = 'Country field cannot be empty!';
        }

        $email = $this->cleanData($input['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msgContainer['email'] = 'Please use a valid email address!';
            } else if ($model->similarEmail($email)) {
                $msgContainer['email'] = "This email: \"$email\" already exists!";
            }
        } else {
            $msgContainer['email'] = 'Email address field cannot be empty!';
        }

        $data['resultOk'] = false;
        if (empty($msgContainer)) {

            $data_arr = [
                'fname'       => $fname,
                'sname'       => $sname,
                'birthday'    => date('Y-m-d', strtotime($birthday)),
                'report_subj' => $report_subj,
                'country'     => $country,
                'phone'       => $input['phone'],
                'email'       => $email
            ];

            if ($model->addUser($data_arr)) {
                $request->session()->put('user_email', $email);
                $data['resultOk'] = true;
            } else {
                $msgAlertDanger = 'Registration failed, Please try again!';
            }
        }

        $data['msgErrorInput'] = $msgContainer;
        if (isset($msgAlertDanger)) $data['msgError'] = $msgAlertDanger;

        return Response::json($data);
    }

    public function validat2(Request $request)
    {
        $model = new RM;

        $input = $request->all();

        $msg = '';

        $company = $this->cleanData($input['company']);
        $company = filter_var($company, FILTER_SANITIZE_STRING);
        if (!empty($company)) {
            if (!$this->okCheckLenght($company, 0, 50)) {
                $msg .= "<div class='alert alert-danger'> Company can have to 50 letters! </div>";
            }
        }

        $position = $this->cleanData($input['position']);
        $position = filter_var($position, FILTER_SANITIZE_STRING);
        if (!empty($position)) {
            if (!$this->okCheckLenght($position, 0, 50)) {
                $msg .= "<div class='alert alert-danger'> Position can have to 50 letters! </div>";
            }
        }

        $aboutme = $this->cleanData($input['aboutme']);
        $aboutme = filter_var($aboutme, FILTER_SANITIZE_STRING);
        if (!empty($aboutme)) {
            if (!$this->okCheckLenght($aboutme, 0, 255)) {
                $msg .= "<div class='alert alert-danger'> 'About me' can have to 255 letters!; </div>";
            }
        }

        $fname = '';
        if (!empty($input['uploadfile']) && is_uploaded_file($_FILES['fname']['tmp_name'])) {

            $path = "/assets/images/"; //Config::get('pathUploadImg');    //$path = "/assets/images/";

            $fname = $_FILES['fname']['name'];
            $extension = strtolower(substr(strrchr($fname, '.'), 1));

            $types = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
            if (!in_array($extension, $types)) {
                $msg .= "<div class='alert alert-danger'> The file should be an image. </div>";
            }

            if ($_FILES['fname']['size'] > 1024 * 6 * 1024) {
                $msg .= "<div class='alert alert-danger'> Maximum image file size is 6 Mb. </div>";
            }

            if ($_FILES['fname']['size'] < 1024) {
                $msg .= "<div class='alert alert-danger'> Photo size is very small. </div>";
            }


            $fnameRand = $this->getRandomFileName($path, $extension);

            $uploadf = '.' . $path . $fnameRand . '.' . $extension;

            if (empty($msg)) {
                if (!move_uploaded_file($_FILES['fname']['tmp_name'], $uploadf)) {
                    $msg .= "<div class='alert alert-danger'> Photo was not saved! </div>";
                }

                $fname = $fnameRand . '.' . $extension;
            }
        }

        if (empty($msg)) {

            if (!empty($company) || !empty($position) || !empty($aboutme) || !empty($fname)) {
                $data_arr = [
                    'company'  => $company,
                    'position' => $position,
                    'about_me' => $aboutme,
                    'photo'    => $fname,
                    'email'    => $request->session()->get('user_email')
                ];

                if ($model->updateData($data_arr)) {
                    $msg = "<div class='alert alert-success text-center'>Registration has been successfully!</div>";
                    $request->session()->flush();
                } else {
                    $msg .= "<div class='alert alert-danger'> Registration failed, Please try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-success text-center'>Registration has been successfully!</div>";
                $request->session()->flush();
            }
        }

        echo $msg;
    }

    protected function cleanData($data = "")
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function okCheckLenght($data = "", $min, $max)
    {
        return (mb_strlen($data) >= $min && mb_strlen($data) <= $max);
    }

    protected function getRandomFileName($path, $extension = '')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = uniqid();
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }

    /* public function test()
     {
         $user = DB::table('users')->where('email', 'maxewewgol76@gmail.com')->first();  // return null if not found

         dd($user);
     }*/


}
