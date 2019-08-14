@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><span class="title">{{ display('Dashboard') }}</span>
            <div class="float-{{ langFloat('right') }}">
                @if(isset($buttons) and $buttons->count() !=0)
                    @foreach($buttons as $btn)
                        <a class="btn btn-{{$btn->type}}" href="{{ $btn->href }}">
                            @if(isset($btn->icon) and !empty($btn->icon)) <i class="fas fa-{{$btn->icon}}"></i>  @endif
                            {{ display($btn->name) }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
{{--            <div class="progress d-none" style="height: 25px;">--}}
{{--                <div class="progress-bar" role="progressbar"  style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--            </div>--}}
                <div class="d-none alert-success alert">
                    {{ display('We work on it! ,Preventing to block your account we need to work on it slowly,, please wait 6 hours or less') }}🤗</>
                <br>
                <b>{{ display('We will notify you when we complete it') }}</b>
                </div>
        <div class="alert d-none alert-danger">

        </div>
            <form action="{{ route('mentions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>{{ display('post link') }}</label>
                    <input type="url" required class="form-control" name="url" placeholder="{{ display('post link')  }}">
                </div>
                <div class="form-group">
                    <label>{{ display('Post Category') }}</label>
                    <select required class="form-control" name="cat">
                        <option disabled >{{ display('Post Category') }}</option>
                        <option disabled>----------------------</option>
                        @php($i = 1)
                        @foreach($catList as $key=> $cat)
                            <option value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>{{ display('Count of mentions') }} [ "max" = 100, "min" = {{ $step }}, "step" = {{ $step }}]</label>
                    <input type="number" value="{{ $step }}" step="{{ $step }}" class="form-control" min="{{ $step }}" max="100"  name="count" placeholder="{{ display('Count of mentions')  }}">
                </div>
                <button type="submit" class="btn btn-success float-{{ langFloat('right') }}">{{ display('do mentions') }}</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $("input[type='number']").attr({
            "max" : 100,
            "min" : "{{ $step }}"
        });


        function load(int){
            if(int == 1){
                $('[type="submit"]').attr('disabled','disabled');
                // $('.progress').removeClass('d-none');
                $('[type="submit"] > .txt').addClass('d-none');
                // $('form').loading('start')
            }else {
                $('[type="submit"]').removeAttr('disabled');
                // $(".progress").addClass('d-none');
                $('[type="submit"] > .spin').addClass('d-none');
            }
        }

        $(document).on("submit", "form", function(e){
            e.preventDefault();
            load(1);
            var $timeToLoad = ($('[name="count"]').attr('step') * $('[name="count"]').val())*{{ $sleep }};
            console.log($timeToLoad);
            $(".progress-bar").css({"width":"100%","transition":$timeToLoad+"s"}).text('please just wait : '+parseInt($timeToLoad/60)+'m');

            $('.alert-danger').addClass('d-none');
            $('.alert-success').removeClass('d-none')

            $.post( $(this).baseURI, $(this).serialize())
                .done(function( data,status ) {
                    load(0);
                    $msg = data;
                    console.log($msg)
                })
                .fail(function ( data,status ) {
                    load(0);
                    var $msg = '';
                    if (data.status == 404){
                        $('.alert-success').addClass('d-none');
                        $('.alert-danger').removeClass('d-none').html(data.responseJSON.msg);
                    }
                });
            return  false;
        });
    </script>
@endpush
