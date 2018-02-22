@extends('layouts.app')
@section('content')


    {{--{{ Breadcrumbs::render(Route::currentRouteName()) }}--}}

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> New User Profile | Account
        {{--<small>user account page</small>--}}
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </h1>

    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->

            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if(isset($user->userInfo->photo))
                            <img src="{{asset($user->userInfo->photo)}}" class="img-responsive" alt=""> </div>
                    @else
                        <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
            @endif
            <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{$user->name}} </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->

            </div>
            <!-- END PORTLET MAIN -->

        </div>

        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li >
                                    <a href="{!! route('profile') !!}">Personal Info</a>
                                </li>
                                @if($user->hasRole('selfteach') || $user->hasRole('employee'))
                                    <li >
                                        <a href="{!! route('course.enrolled') !!}">Enrolled Courses</a>
                                    </li>
                                @endif
                                @if($user->hasRole('tutor'))
                                    <li class="active">
                                        <a href="{!! route('course.made') !!}">Courses</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{!! route('profile.pic.change') !!}">Change Avatar</a>
                                </li>
                                <li>
                                    <a href="{!! route('profile.password.reset') !!}">Change Password</a>
                                </li>

                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active">

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th> Course </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courses as $course)
                                            <tr class="odd gradeX">
                                                <td>
                                                    {{ $course->title }}
                                                </td>
                                                {{--<td>--}}
                                                    {{--{{ $course->result }}--}}
                                                {{--</td>--}}
                                                {{--<td> <a href="{{ route('course.enrolled_remove',$course->id) }}" class="btn btn-xs btn-success">Remove</a> </td>--}}

                                        @endforeach


                                        </tbody>
                                    </table>

                                </div>
                                <!-- END PERSONAL INFO TAB -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{!! asset('assets/global/plugins/datatables/datatables.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}">

@endsection

@section('scripts')
    <script type="text/javascript" src="{!! asset('assets/global/plugins/datatables/datatables.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}"></script>
    <!-- for Datatable -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').dataTable({
                "order": [[ 1, "asc" ]]
            });
            $(document).on("click", ".deleteBtn", function() {
                console.log('pppp');
                var deleteUrl = $(this).attr('deleteUrl');
                $(".deleteForm").attr("action", deleteUrl);
            });
        });
    </script>

@endsection