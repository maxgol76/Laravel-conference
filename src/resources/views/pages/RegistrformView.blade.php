@extends('index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div id="map"></div>
    </div>
</div>

<div class="container container-forms">
    <div class="row">

        <div class="hidden-xs col-sm-2 col-md-3 col-lg-4"></div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
            <div class="starter-template">

                <div class="text-center"><h3 class="form-signin-heading">To participate in the conference,</br> please fill out the form:</h3></div>

                <div class="text-center"><a type="button" class="btn btn-link" href="/list/show">All members
                        (<span id="count-members">{{ $countMembers }}</span>)</a></div>

                @if (null == Session::get('user_email'))

                <form action="" role="form" method="post" id="form-registr">

                    <div id="alert-msg"></div>
                    <div class="form-group" id="fname">
                        <label id="lb-fname">First Name*</label>
                        <input type="text" class="form-control" placeholder="First Name" name="fname" required
                               autofocus>   <!--pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,50}$"-->
                        <span id="error-fname" class="help-block"></span>
                    </div>


                    <div class="form-group" id="sname">
                        <label id="lb-sname">Last Name*</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="sname" required>
                        <span id="error-sname" class="help-block"></span>
                    </div>


                    <div class="form-group">
                        <label id="lb-birthday">Birth date*</label>
                        <input type="text" class="form-control" id="datetimepicker1" placeholder="Birth date" name="birthday" id="birthday"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                        <span id="error-birthday" class="help-block"></span>
                    </div>


                    <div class="form-group" id="reportsubj">
                        <label id="lb-reportsubj">Report subject*</label>
                        <input type="text" class="form-control" placeholder="Report subject" name="reportsubj" required>
                        <span id="error-reportsubj" class="help-block"></span>
                    </div>


                    <div class="form-group">
                        <label id="lb-country">Country*</label>
                        <select class="form-control" name="country" id="country" required>
                            <option></option>
                        </select>
                        <span id="error-country" class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label id="lb-phone">Phone*</label>
                        <input type="text" class="form-control" placeholder="+1 (___) ___-____" name="phone" id="phone"
                               pattern="\+1 \([0-9]{3}\) [0-9]{3}-[0-9]{4}" required>
                    </div>

                    <div class="form-group" id="email">
                        <label id="lb-email" for="inputEmail">Email address*</label>
                        <input type="email" class="form-control" placeholder="Email address" name="email"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        <span id="error-email" class="help-block"></span>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_reg" id="btnsignup">Next</button>
                </form>

                @endif

                <form action="/registrat/validat2" role="form" method="post" id="form-registr2" enctype="multipart/form-data">

                    <div id="alert-msg-form2"></div>

                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" placeholder="Company" name="company" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" class="form-control" placeholder="Position" name="position">
                    </div>

                    <div class="form-group">
                        <label>About me</label>
                        <textarea rows="8" cols="100" class="form-control" id="message" name="aboutme" placeholder="Text"></textarea>
                    </div>

                    <div class="form-group">

                        <label>Upload your photo please </label><br>

                        <div id="borderUploadIng" >

                            <input type="text" id="uploadFile" placeholder="Photo"  name="uploadfile" readonly />
                            <label class="custom-file-input">
                                <input type="file" id="uploadBtn" name="fname" accept="image/*">
                            </label>
                        </div>
                        <div>
                            <button type="button" class="btn btn-warning" id="del-photo">Delete photo</button>
                        </div>
                    </div>


                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_reg2" id="btnsignup2">Next</button>
                </form>

                <div id="soc-icon" class="text-center">
                    <i class="fa">
                        <a class="btn btn-block btn-social btn-google" id="google-plus" name="{{$url}}">
                            <span class="fa fa-google"></span> Share on Google+
                        </a>
                    </i>

                    <i class="fa">
                        <a class="btn btn-block btn-social btn-tumblr" id="twitter" title="{{$twitterTitle}}" name="{{$url}}">
                            <span class="fa fa-tumblr"></span> Share on Twitter
                        </a>
                    </i>

                    <i class="fa">
                        <a class="btn btn-block btn-social btn-facebook" id="faceb" name="{{$url}}">
                            <span class="fa fa-facebook"></span> Share on Facebook
                        </a>
                    </i>
                </div>

                <div class="hidden-xs col-sm-2 col-md-3 col-lg-4"></div>
            </div>
        </div><!-- /.container -->
@stop



