@extends('admin.master')

@section('main_content')
    <style>
        #previewImg{
            height: 100px;
            width: 100px;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layouts._message')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Content Header  Title -->
                        <h1>{{ __('Reporter') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Reporter') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Reporter') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header col-12 row ">

                                <div class="col-10">
                                    <h3 class="card-title">{{ __('New Reporter') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.reporter') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.reporter.update',$reporter->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputImage" >{{ __('Image') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    @if(($reporter->image))
                                                    <img id="previewImg" src="{{ asset($reporter->image) }}" alt="image" >
                                                    @endif
                                                    <p>
                                                        <input type="file" class="form-control" name="image" onchange="previewFile(this);" >
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputTitle">{{ __('First Name') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{ $reporter->first_name }}" >
                                                    @error('first_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputTitle">{{ __('Last Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{ $reporter->last_name }}" >
                                                    @error('last_name')
                                                    <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputEmail">{{ __('Email') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{ $reporter->email }}" >
                                                    @error('email')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPhone">{{ __('Phone') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="{{ $reporter->phone }}" >
                                                    @error('phone')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputNationalId">{{ __('National ID') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="national_id" id="national_id" placeholder="national id" value="{{ $reporter->national_id }}" >
                                                    @error('national_id')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputFatherName">{{ __('Father Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father name" value="{{ $reporter->father_name }}" >
                                                    @error('father_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputMotherName">{{ __('Mother Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother name" value="{{ $reporter->mother_name }}" >
                                                    @error('mother_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPresentAddress">{{ __('Present Address') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <textarea class="form-control" name="present_address" id="present_address"> {{ $reporter->present_address }}

                                                    </textarea>
                                                    @error('present_address')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPermanentAddress">{{ __('Permanent Address') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <textarea class="form-control" name="permanent_address" id="permanent_address"> {{ $reporter->permanent_address }}

                                                    </textarea>
                                                    @error('permanent_address')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputAppointedDate">{{ __('Appointed Date') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input type="text" name="appointed_date" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{  date('m-d-Y', strtotime($reporter->appointed_date)) }}"/>
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                    @error('appointed_date')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPassword">{{ __('Password') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="******" >
                                                    @error('password')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputMotherName">{{ __('Confirm Password') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="******" >
                                                    @error('password_confirmation')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-3 col-md-3 col-form-label"  for="role">{{ __('Role') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <select  class="form-control" name="role" id="roleedit" >
                                                        @foreach($roles as $role)
                                                            <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}"{{ $reporter->roles->isEmpty() || $role->name !=$reporterRole->name ? "" : "selected" }}>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" id="permissions_box">
                                                    <label for="permission">{{ __('Select Permissions') }}</label>
                                                    <div id="permissions_checkbox_list">

                                                    </div>
                                                </div>
                                                @if($reporter->permissions->isNotEmpty())
                                                    @if($rolePermissions !=null)
                                                        <div class="form-group" id="user_permissions_box">
                                                            <label for="permission">{{ __('User Permissions' )}}</label>
                                                            <div id="user_permissions_checkbox_list">
                                                                @foreach($rolePermissions as $permission)
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id,$reporterPermissions->pluck('id')->toArray()) ? 'checked="checked"' : '' }}>
                                                                        <label class="custom-control-label" for="{{$permission->slug}}">{{ $permission->name }}</label>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer justify-content-between">

                                        <button type="submit" class="btn btn-info">{{ __('update') }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
