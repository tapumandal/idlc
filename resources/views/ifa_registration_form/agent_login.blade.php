<?php //echo public_path();exit;                                                     ?>

@extends('layouts.idlc_aml.app')
@section('content')
    <style type="text/css">
        body {
            position: relative;
        }
        .nav-pills{
            border : 1px solid #DDD;
            background: #ce2327;
        }
        .nav > li >a{
            color:#fff;
            text-align: center;
        }
        .nav-pills > li.active > a,
        .nav-pills > li.active > a:focus,
        .nav-pills > li.active > a:hover {
            color: #fff;
            background-color: maroon;
        }

        .nav > li > a:focus,
        .nav > li > a:hover {
            text-decoration: none;
            background-color: maroon;
        }
        .nav .li_1{
            width: 31.3%;
        }

        @media(max-width: 580px){
            .nav .li_1{
                width: 100%;
            }
            .nav li{
                width: 100%;
            }
        }
    </style>

    <div class="col-sm-4 col-sm-offset-4">

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert"  id="">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong id="">{{ $errors->first() }}</strong>
            </div>
        @endif

        <form method="POST" action="{{route('ifa_registration.login')}}" accept-charset="UTF-8" class="form-signin">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">

            <div class="form-group has-feedback{{ $errors->has('application_no') ? ' has-error' : ''}}">
                {{-- <input type="text" id="application_no" name="application_no" class="form-control" placeholder="Application No." value="" required autofocus/> --}}
                <input type="text" id="application_no" name="user_name" class="form-control" placeholder="User Name" value="" required autofocus/>
                <span class="glyphicon glyphicon-list form-control-feedback"></span>
                @if($errors->has('application_no'))
                    <span class="help-block">{{ $errors->first('application_no') }}</span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : ''}}">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="row">

                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>

    </div>

@endsection
