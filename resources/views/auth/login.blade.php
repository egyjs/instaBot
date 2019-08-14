@extends('layouts.insta')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div>
                <a href="{{ url()->previous() }}" >&larr; {{display('back')}}</a> <span class="text-danger font-weight-bold">{{ display('or') }}</span> <span>{{display('login with Instagram')}}</span>
                <div class="card-body">
                    <div class="InstaLogo align-items-center justify-content-center"
                         style="background-image: url({{ asset('img/instagram.png') }});">

                    </div>
                    <form method="POST" action="{{ route('login') }}" autocomplete="none">
                        @csrf
                        <div class="form-label-group">
                            <input autocomplete="off" id="username" name="username" class="form-control" placeholder="{{ display('Phone number, username, or email') }}" required autofocus>
                            <label for="username">{{display('Phone number, username, or email')}}</label>
                        </div>
                        <div class="form-label-group">
                            <input autocomplete="off" id="pass" name="password" class="form-control" placeholder="{{ display('Password') }}" required type="password">
                            <label for="pass">{{display('Password')}}</label>
                        </div>

                        <button  class="btn btn-block btn-primary" type="submit">
                            <div class="gray spin d-none justify-content-center m-auto text-center" style="width: max-content;">
                                <div class="ispinner gray animating">
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                    <div class="ispinner-blade"></div>
                                </div>
                            </div>
                            <div class="txt">{{ display('Log In') }}</div>
                        </button>

                        <div class="text-center mt-3 font-weight-bold"><a class="_8Bp8U" href="https://instagram.com/accounts/password/reset/">{{display('IF Forgot password')}}?</a></div>
                        <div  class="  state  d-none col-12"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        function load(int){
            if(int == 1){
                $('[type="submit"]').attr('disabled','disabled');
                $('[type="submit"] > .spin').removeClass('d-none');
                $('[type="submit"] > .txt').addClass('d-none');
            }else {
                $('[type="submit"]').removeAttr('disabled');
                $('[type="submit"] > .txt').removeClass('d-none');
                $('[type="submit"] > .spin').addClass('d-none');
            }
        }
        $(document).on("submit", "form", function(e){
            e.preventDefault();
            load(1);
            $.post( $(this).baseURI, $(this).serialize())
                .done(function( data,status ) {
                    load(0);
                    if (data.url){
                        $('.state').removeClass('d-none text-danger').addClass('text-success').text('you login successfully');
                        setTimeout(function(){
                            window.location.href = data.url;
                        },200);
                    }else {
                        $msg = data;
                        $('.state').removeClass('d-none')
                            .addClass('text-danger')
                            .text('Unknown Error');
                        console.log($msg)
                    }
                })
                .fail(function ( data,status ) {
                    load(0);
                    var $msg = '';
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors,function (item) {
                            $msg += item+' and ';
                        });
                        $('.state').removeClass('d-none').addClass('text-danger').text('Error with:' +
                            $msg
                            + 'is required');
                    }else if(data.status == 401){
                        $msg = data.responseJSON.error;
                        $('.state').removeClass('d-none').addClass('text-danger').text($msg);
                    }else {
                        $msg = data;
                        $('.state').removeClass('d-none').addClass('text-danger').text('Unknown Error');
                        console.log($msg)
                    }
                });
            return  false;
        });
    </script>
@endpush
