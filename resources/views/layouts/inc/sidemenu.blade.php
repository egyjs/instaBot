@foreach(\TCG\Voyager\Models\Page::all() as $page)
    <a class="d-block" href="{{ route('page',$page->slug) }}">{{ $page->title }}</a>
@endforeach
@auth()
    <a class="d-block" href="{{ route('mentions.index') }}">{{ display("my mentions") }}</a>
@else
    <a class="d-block" href="{{ route('mentions.index') }}">{{ display('login with Instagram') }}</a>
@endauth
