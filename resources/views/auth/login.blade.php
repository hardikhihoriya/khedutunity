@extends('layouts.admin-master-basic')
@section('content')
<style>
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }
</style>

<div class="login-box-body">   
    
    <div class="imgcontainer">
        <img src="{{asset('/images/logo.png')}}" alt="Avatar" class="avatar">
    </div>

    <form class="form-horizontal" id="loginForm" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" maxlength="100" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">  
            <div class="">
                <button type="submit" id="login_submit">Sign In</button>
            </div>
        </div>
    </form>

</div>
@endsection
@section('script')
<script>
    jQuery(document).ready(function () {
        var loginRules = {
            username: {
                required: true

            },
            password: {
                required: true
            }
        };
        $("#loginForm").validate({
            rules: loginRules,
            messages: {
                username: {
                    required: 'Enter username'
                },
                password: {
                    required: 'Enter password'
                }
            }
        });
    });
</script>
@endsection

