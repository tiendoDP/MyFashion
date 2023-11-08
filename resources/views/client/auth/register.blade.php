
@extends('client.layouts.app')

@section('styles')

@endsection

@section('content')
   <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <div class="nav-link p-4" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true" style="font-size: 30px">Register</div>
                        </li>
                    </ul>
                    @if(!empty(session('error')))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label >Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror                    
                                <div class="form-group">
                                    <label for="register-email-2">Your email address *</label>
                                    <input type="email" class="form-control" id="register-email-2" value="{{old('email')}}" name="email">
                                </div><!-- End .form-group -->
                                @error('email')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                                <div class="form-group">
                                    <label for="register-password-2">Password *</label>
                                    <input type="password" class="form-control" id="register-password-2" value="{{old('password')}}" name="password">
                                </div><!-- End .form-group -->
                                @error('password')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="register-policy-2" name="check">
                                        <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                                    </div>
                                    @error('check')
                                    <small class="form-text text-muted">
                                    <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div><!-- End .form-footer -->
                            </form>
                            <div class="form-choice">
                                <p>You have account? <a href="{{route('login')}}">Login</a></p>
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            Login With Google
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login  btn-f">
                                            <i class="icon-facebook-f"></i>
                                            Login With Facebook
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .form-choice -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->

@endsection

@section('scripts')

@endsection