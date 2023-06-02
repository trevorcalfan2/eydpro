


@extends('frontend.layouts.app')
<style>

.round {
    height: 100px;
    width: 120px;
    background-color: blue;
    border-radius: 25px; 
    }
.red{

    color: red;
}


</style>
@section('content')
    <section class="gry-bg py-6">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="card shadow-none rounded-0 border">
                            <div class="row">
                                <!-- Left Side -->
                                <div class="col-lg-6 col-md-7 p-4 p-lg-5">
                                    <!-- Titles -->
                                    <div class="text-center">
                                        <h1 class="fs-20 fs-md-24 fw-700 text-primary">Crear una cuenta</h1>
                                    </div>
                                    <!-- Register form -->
                                    <div class="pt-3 pt-lg-4">
                                        <div class="">
                                            <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name" class="fs-12 fw-700 text-soft-dark">Nombre Completo</label>
                                                    <input type="text" class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Email or Phone -->
                                                @if (addon_is_activated('otp_system'))
                                                    <div class="form-group phone-form-group mb-1">
                                                        <label for="phone" class="fs-12 fw-700 text-soft-dark">{{  translate('Phone') }}</label>
                                                        <input type="tel" id="phone-code" class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                                    </div>

                                                    <input type="hidden" name="country_code" value="">

                                                    <div class="form-group email-form-group mb-1 d-none">
                                                        <label for="email" class="fs-12 fw-700 text-soft-dark">Email</label>
                                                        <input type="email" class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group text-right">
                                                        <button class="btn btn-link p-0 text-primary" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label for="email" class="fs-12 fw-700 text-soft-dark">Email</label>
                                                        <input type="email" class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif

                                                <!-- password -->
                                                <div class="form-group">
                                                    <label for="password" class="fs-12 fw-700 text-soft-dark">Contraseña</label>
                                                    <input type="password" id = "pwdtxt" class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password">
                                                    <div class="text-right mt-1">
                                                        <span class="fs-12 fw-400 text-gray-dark"></span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- password Confirm -->
                                                <div class="form-group">
                                                    <label for="password_confirmation" class="fs-12 fw-700 text-soft-dark">Confirmar Contraseña</label>
                                                    <input type="password" id= "pwdctxt" class="form-control rounded-0" placeholder="Confirmar Contraseña" name="password_confirmation">
                                                </div>

                                                <!-- Recaptcha -->
                                                @if(get_setting('google_recaptcha') == 1)
                                                    <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                                    </div>
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                @endif

                                                <!-- Terms and Conditions -->
                                                <div class="mb-3">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" name="checkbox_example_1" required>
                                                        <span class="">Registrandote estas deacuerdo con nuestros <a href="{{ route('terms') }}" class="fw-500">terminos y condiciones</a></span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-4 mt-4">
                                                    <button type="submit" class="btn btn-primary btn-block fw-600 rounded-4">Crear Cuenta</button>
                                                </div>
                                            </form>
                                            
                                            <!-- Social Login -->
                                            @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                                <div class="text-center mb-3">
                                                    <span class="bg-white fs-12 text-gray">{{ translate('Or Join With')}}</span>
                                                </div>
                                                <ul class="list-inline social colored text-center mb-4">
                                                    @if (get_setting('facebook_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                                <i class="lab la-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(get_setting('google_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                                <i class="lab la-google"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('twitter_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                                <i class="lab la-twitter"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('apple_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                                                <i class="lab la-apple"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>

                                        <!-- Log In -->
                                        <div class="text-center">
                                            <p class="fs-12 text-gray mb-0">¿Ya tienes una cuenta?</p>
                                            <a href="{{ route('user.login') }}" class="fs-14 fw-700 animate-underline-primary">Inicia Sesion</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Side Image -->
                                <div class="col-lg-6 col-md-5 py-3 py-md-0 my-auto">
                                    <!--<img src="{{ uploaded_asset(get_setting('register_page_image')) }}" alt="" class="img-fit h-100">-->
                                    <div >


                                        <div class="container " id = "">
                                            
                                            <div class="row mb-2">
                                              <div class="col-sm">
                                                <i class="fa fa-check fa-2x" id = "onereq"></i>
                                              </div>
                                              <div class="col-sm  " style ="margin-left: -320px">
                                                <h5>Debe contener una letra</h5>
                                            </div>

                                            </div>

                                             <div class="row mb-2">
                                              <div class="col-sm">
                                                <i class="fa fa-check fa-2x" id = "tworeq"></i>
                                              </div>
                                              <div class="col-sm  " style ="margin-left: -320px">
                                                <h5>Debe contener una letra en mayuscula</h5>
                                            </div>
                                            
                                            </div>


                                            <div class="row mb-2" >
                                                <div class="col-sm">
                                                  <i class="fa fa-check fa-2x" id = "threereq"></i>
                                                </div>
                                                <div class="col-sm  " style ="margin-left: -320px">
                                                  <h5>Debe contener como minimo 8 caracteres</h5>
                                              </div>
                                              
                                              </div>

                                              <div class="row mb-2">
                                                <div class="col-sm">
                                                  <i class="fa fa-check fa-2x" id = "fourreq"></i>
                                                </div>
                                                <div class="col-sm  " style ="margin-left: -320px">
                                                  <h5>Debe contener una numero</h5>
                                              </div>
                                              
                                              </div>
                                              <div class="row mb-2">
                                                <div class="col-sm">
                                                  <i class="fa fa-check fa-2x" id = "fivereq"></i>
                                                </div>
                                                <div class="col-sm  " style ="margin-left: -320px">
                                                  <h5>Debe contener un caracter especial</h5>
                                              </div>
                                              
                                              </div>






                                        </div>

                                      

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif




    <script>

$('form').on('submit', function() {
  
    var pwdtxt = $("#pwdtxt").val();
                
                if(allLetter(pwdtxt)){
                    if(containsUppercase(pwdtxt)){
                        if(pwdtxt.length >= 8){
                            if(containsNumbers(pwdtxt)){
                                if(containsSpecialCharacters(pwdtxt)){
                                }else{alert("la contraseña no cumple con los requerimientos"); return false;}
                            }else{alert("la contraseña no cumple con los requerimientos"); return false;}
                        }else{alert("la contraseña no cumple con los requerimientos"); return false;}
                    }else{alert("la contraseña no cumple con los requerimientos"); return false;}
                }else{alert("la contraseña no cumple con los requerimientos"); return false;}
});







    </script>
    <script type="text/javascript">

        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here

               

                $("#reg-form").submit();




              
            });
        });
        @endif

        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('<i>*{{ translate('Use Phone Number Instead') }}</i>');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('*{{ translate('Use Email Instead') }}');
            }
        }


    </script>

    <script>



var pwdtxt = $("#pwdtxt").val();

if(pwdtxt.length<1){
    $('#onereq').css('color', 'red');
    $('#tworeq').css('color', 'red');
    $('#threereq').css('color', 'red');
    $('#fourreq').css('color', 'red');
    $('#fivereq').css('color', 'red');
}

$('#pwdtxt').on('input', function(){
  

              pwdtxt = $("#pwdtxt").val();



                if(pwdtxt.length<1){
                    $('#onereq').css('color', 'red');
                    $('#tworeq').css('color', 'red');
                    $('#threereq').css('color', 'red');
                    $('#fourreq').css('color', 'red');
                    $('#fivereq').css('color', 'red');
                }else{

                    if(!allLetter(pwdtxt))
                    {$('#onereq').css('color', 'red');
                    }else{ $('#onereq').css('color', '');}

                    if(!containsUppercase(pwdtxt))
                    {
                        $('#tworeq').css('color', 'red');
                    
                    }else{ $('#tworeq').css('color', '');}
                    if(pwdtxt.length < 8){

                        $('#threereq').css('color', 'red');

                    } else{ $('#threereq').css('color', '');}
                    if(!containsNumbers(pwdtxt)){

                        $('#fourreq').css('color', 'red');

                    }else{ $('#fourreq').css('color', '');}
                    if(!containsSpecialCharacters(pwdtxt)){
                        $('#fivereq').css('color', 'red');
                    }else{ $('#fivereq').css('color', '');}
                    }

                });

             
                function containsUppercase(str) {
                    return str !== str.toLowerCase();
                }
                function allLetter(inputtxt)
                {
                    return /^[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~A-Za-z0-9]*$/.test(inputtxt);
                }
                function containsNumbers(str) {
                return /\d/.test(str);
                    }
                function containsSpecialCharacters(str){
                var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
                return format.test(str)
                }




                
    </script>
@endsection
