@extends(template().'layout.auth')

@section('content')
    @push('seo')
        <meta name='description' content="{{ @$general->seo_description }}">
    @endpush
    <section class="auth-section">
        <div class="auth-wrapper">
            <div class="auth-top-part">
                <a href="{{ route('home') }}" class="auth-logo">
                    <img class="img-fluid rounded sm-device-img text-align" src="{{ getFile('logo', @$general->whitelogo) }}"
                        width="100%" alt="pp">
                </a>
                <p class="mb-0"><span class="me-2">{{ __('Haven\'t an Account?') }}</span> <a class="btn main-btn btn-sm" href="{{ route('user.register') }}">{{ __('Register') }}</a></p>
            </div>
            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Login Your Account') }}</h3>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"
                                placeholder="{{ __('Enter Your Email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput">{{ __('Pasword') }}</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="{{ __('Enter Password') }}">
                        </div>
                        <p class="text-end"><a href="{{ route('user.forgot.password') }}"
                                class="site-color">{{ __('Forget password?') }}</a></p>
                        @if (@$general->allow_recaptcha == 1)
                            <div class="col-md-12 my-3">
                                <script src="https://www.google.com/recaptcha/api.js"></script>
                                <div class="g-recaptcha" data-sitekey="{{ @$general->recaptcha_key }}"
                                    data-callback="verifyCaptcha"></div>
                                <div id="g-recaptcha-error"></div>
                            </div>
                        @endif
                        <button class="btn main-btn w-100 mt-3" type="submit"> <span>{{ __('Log In') }} </span></button>
                    </form>
                </div>
            </div>
            <div class="auth-footer-part">
                <p class="text-center mb-0">
                    @if (@$general->copyright)
                        {{ __(@$general->copyright) }}
                    @endif
                </p>
            </div>
        </div>
        <div class="auth-thumb-area" style="background-image: url('{{ getFile('frontendlogin', @$general->frontend_login_image) }}')">
        </div>
    </section>
@endsection

@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    "<span class='sp_text_danger'>@changeLang('Captcha field is required.')</span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
