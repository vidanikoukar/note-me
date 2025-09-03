@extends('layouts.app')

@section('content')
    <div class="content">
        <h1>نتایج جستجو برای: {{ $query }}</h1>
        @if($results->isEmpty())
            <p>نتیجه‌ای یافت نشد.</p>
        @else
            <ul>
                @foreach($results as $result)
                    <li>
                        <a href="{{ $result->url }}">{{ $result->title }}</a>
                        <span>({{ $result->category }})</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection