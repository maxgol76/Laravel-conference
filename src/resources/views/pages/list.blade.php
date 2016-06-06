@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
           {{-- <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Малая модаль</button>--}}

            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="ModalInfoHidden">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content text-center">
                        <br>
                        <p>Save was successful.</p>

                    </div>
                </div>
            </div>
            <table class="table table-hover" id="tab1">
                <caption class="title_tab text-center"><h3>Members list</h3></caption>
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Report subject</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody id="tbod">
                @foreach ($users as $user)
                    @if (Auth::guest() == false || (Auth::guest() && $user->user_hidden == 0))
                    <tr>
                         <td>
                             @if ($user->photo)
                                 <img class="media-object" src={{asset('assets/images/'.$user->photo)}} alt="" id="avatar">
                             @else
                                 <img class="media-object" src={{asset('img/user-default.jpg')}} alt="">
                             @endif
                         </td>
                         <td>
                             {{ $user->fname }} {{ $user->sname }}
                         </td>

                         <td>
                             {{ $user->report_subj }}
                         </td>

                         <td>
                             <address>
                                 <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                             </address>
                         </td>

                        @if (Auth::guest())
                        @else ( Auth::user()->name == 'admin')
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checking" @if($user->user_hidden == 1) checked @endif id="checkb{{$user->id}}" > hide
                                </label>
                            </div>
                        </td>
                        @endif

                     </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.container -->
@stop