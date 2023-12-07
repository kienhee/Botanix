@extends('layouts.client.index')
@section('title', 'Home')
@section('content')
<section class="brand container">
    <h1 class="brand__title"><img src="{{ asset('client') }}/assets/images/fire.png" alt=""><span>Trending on
            Base</span></h1>

    <div class="brand__box">
        @foreach ($trendings as $item)
        <div class="brand__box-item">
            <img src="{{$item->project->image}}" class="brand__box-item-logo" alt="">
            <h3 class="brand__box-item-text"><span class="brand__box-item-name">{{$item->project->name}}</span>
                @if ($item->project->verify == 1)
                <img class="brand__box-item-verify" src="{{ asset('client') }}/assets/images/verify.png" alt="">
                @elseif ($item->project->verify == 2)
                <img class="brand__box-item-verify" src="{{ asset('client') }}/assets/images/verify2.png" alt="">
                @endif

            </h3>
        </div>
        @endforeach


    </div>
</section>
@endsection