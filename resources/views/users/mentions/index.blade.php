@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><span class="title">Dashboard</span>
            <div class="float-{{ langFloat('right') }}">
                @if(isset($buttons) and $buttons->count() !=0)
                    @foreach($buttons as $btn)
                        <a class="btn btn-{{$btn->type}}" href="{{ $btn->href }}">
                            @if(isset($btn->icon) and !empty($btn->icon)) <i class="fas fa-{{$btn->icon}}"></i>  @endif
                            {{ $btn->name }}
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
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ display('Post id') }}</th>
                    <th scope="col">{{ display('Count') }}</th>
                    <th scope="col">{{ display('status') }}</th>
                    <th scope="col">{{ display('delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($mentions as  $k=> $mention)
{{--                    @php($act = \Spatie\Activitylog\Models\Activity::where('properties->url', $mention->url)->orderBy('id','desc')->first())--}}
{{--                    @php($i = $act->getExtraProperty('i'))--}}

{{--                    {{ dd( preg_match('/(\!)/',$act->description) ,explode('/',$i) )  }}--}}
                    <tr>
                        <th scope="row">{{ $k+1 }}</th>
                        <td><a href="{{ ($mention->url) }}" target="_blank">{{ ($mention->url) }}</a> </td>
                        <td>{{ $mention->count }}</td>
                        <td>{!!  $mention->status() !!}</td>
                        <td>
                            @if(!$mention->trashed())
                               <a class="btn btn-danger" href="{{ route(getModal().'.delete',$mention->id) }}"> <i class="fas fa-minus"></i> {{display('delete')}}</a>
                            @else
                                <a class="btn btn-info" href="{{ route(getModal().'.delete',$mention->id) }}"> <i class="fas fa-plus"></i> {{display('restore')}}</a>

                            @endif
                        </td>
                    </tr>

                @empty
                    <td scope="col"><h4>{{ display('there is no mentions!') }}</h4></td>

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
