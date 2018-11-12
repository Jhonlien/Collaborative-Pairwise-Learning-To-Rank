<!DOCTYPE html>
<html>
<head>
    <title> Admin - Login .::My Anime::. </title>
    @include('asset.asset')
</head>
<style type="text/css">
  body{
    background: linear-gradient(87deg, #29ab9f 0, #4fd0ab 100%) !important
  }
</style>
<body>
  @include('sweetalert::alert')
    <div class="section"></div>
    <center>
      <div class="container">
        <div class="z-depth-1 lighten-5 white hoverable" id="login-box" style="margin-top:50px;display: inline-block; padding: 20px 60px 0px 60px; width:450px;border: 1px solid #EEE; border-radius: 10px;">
          <img class="responsive-img" style="width: 250px;" src="{{asset('img/logo.png')}}" />
          <form class="col s12" id="form" method="POST" action="{{route('post.login')}}">
            {{ csrf_field() }}
            <div class='row'>
              <div class='col s12'>
                 <div class="form-group">
                </div>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12 {{ $errors->has('username') ? ' has-error' : '' }}">
                <input type='text' name='username' id="email" autocomplete="off" />
                <label for='email'>Enter your Username</label>

                @if ($errors->has('username'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif

              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type='password' name='password' id="password" autocomplete="off" />
                <label for='password'>Enter your password</label>
                 @if ($errors->has('password'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            <br />
            <center>
              <div class='row'>
                <button type='submit' name='login' class='col s12 btn btn-large waves-effect waves-light teal disabled' id="btn-login">Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </center> 
   
  <script type="text/javascript">
    $(document).ready(function(){
        $('#form').on('click change keyup', function(){
          if($('#username').val() == "" || $('#password').val() == ""){
              $('#btn-login').addClass('disabled');
          }
          else{
            $('#btn-login').removeClass('disabled');
          }
        }); 
      });
  </script>
</body>
</html>
