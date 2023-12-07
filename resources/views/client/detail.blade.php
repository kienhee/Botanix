@extends('layouts.client.index')
@section('title', 'Home')
@section('content')
<section class="brand-detail container">
    <div class="brand-detail__col-left">
        <div class="brand-detail__info">
            <img src="{{$project->image}}" class="brand-detail__info-img" />
            <div class="brand-detail__info-box">
                <h2 class="brand-detail__info-name">{{$project->name}}
                    @if ($project->verify == 1)
                    <img src="{{ asset('client') }}/assets/images/verify.png" alt="">
                    @elseif ($project->verify == 2)
                    <img src="{{ asset('client') }}/assets/images/verify2.png" alt="">
                    @endif
                </h2>
                <div class="brand-detail__feature brand-detail__mobile">
                    <a href="{{$project->website}}" target="_blank" class="brand-detail__btn-dark">Visit Website</a>
                    <button class="brand-detail__btn-opacity" onclick="shareTW()">Share</button>
                    <div class="brand-detail__btn-opacity">
                        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                    </div>
                </div>
                <u class="brand-detail__socials brand-detail__mobile">
                    @if ($project->docs)
                    <li><a title="Documents" href="{{ $project->docs }}" target="_blank"><i
                                class="fa-regular fa-compass"></i></a>
                    </li>
                    @endif
                    @if ($project->facebook)
                    <li><a title="Facebook" href="{{ $project->facebook }}" target="_blank"><i
                                class="fa-brands fa-facebook"></i></a>
                    </li>
                    @endif
                    @if ($project->telegram)
                    <li><a title="Telegram" href="{{ $project->telegram }}" target="_blank"><i
                                class="fa-brands fa-telegram"></i></a>
                    </li>
                    @endif
                    @if ($project->medium)
                    <li><a title="Medium" href="{{ $project->medium }}" target="_blank"><i
                                class="fa-brands fa-medium"></i></a>
                    </li>
                    @endif
                    @if ($project->twitter)
                    <li><a title="Twitter" href="{{ $project->twitter }}" target="_blank"><i
                                class="fa-brands fa-twitter"></i></a>
                    </li>
                    @endif
                    @if ($project->github)
                    <li><a title="Github" href="{{ $project->github }}" target="_blank"><i
                                class="fa-brands fa-github"></i></a>
                    </li>
                    @endif
                    @if ($project->discord)
                    <li><a title="Discord" href="{{ $project->discord }}" target="_blank"><i
                                class="fa-brands fa-discord"></i></a>
                    </li>
                    @endif
                </u>
                <p class="brand-detail__info-short-description">{{$project->short_description}}</p>
                <a href="{{route('client.project',[" category"=>$project->category->slug])}}"
                    class="tag">{{$project->category->name}}</a>
            </div>

        </div>
        <div class="brand-detail__description">
            <h2 class="brand-detail__description-title">
                About Baseverify
            </h2>
            <p>{{$project->description}}
            </p>
        </div>
    </div>
    <div class="brand-detail__col-right">
        <div class="brand-detail__feature">
            <a href="{{$project->website}}" target="_blank" class="brand-detail__btn-dark">Visit Website</a>
            <button class="brand-detail__btn-opacity" onclick="shareTW()">Share</button>
            <div class="brand-detail__btn-opacity">
                <ion-icon name="ellipsis-vertical-outline"></ion-icon>
            </div>
        </div>
        <u class="brand-detail__socials">
            @if ($project->docs)
            <li><a title="Documents" href="{{ $project->docs }}" target="_blank"><i
                        class="fa-regular fa-compass"></i></a>
            </li>
            @endif
            @if ($project->facebook)
            <li><a title="Facebook" href="{{ $project->facebook }}" target="_blank"><i
                        class="fa-brands fa-facebook"></i></a>
            </li>
            @endif
            @if ($project->telegram)
            <li><a title="Telegram" href="{{ $project->telegram }}" target="_blank"><i
                        class="fa-brands fa-telegram"></i></a>
            </li>
            @endif
            @if ($project->medium)
            <li><a title="Medium" href="{{ $project->medium }}" target="_blank"><i class="fa-brands fa-medium"></i></a>
            </li>
            @endif
            @if ($project->twitter)
            <li><a title="Twitter" href="{{ $project->twitter }}" target="_blank"><i
                        class="fa-brands fa-twitter"></i></a>
            </li>
            @endif
            @if ($project->github)
            <li><a title="Github" href="{{ $project->github }}" target="_blank"><i class="fa-brands fa-github"></i></a>
            </li>
            @endif
            @if ($project->discord)
            <li><a title="Discord" href="{{ $project->discord }}" target="_blank"><i
                        class="fa-brands fa-discord"></i></a>
            </li>
            @endif
        </u>
    </div>
</section>
<script>
    function shareTW() {
console.log(1);
// URL bạn muốn chia sẻ
var shareUrl = window.location.href; // Thay đổi thành URL của bạn

// Tạo liên kết chia sẻ Twitter
var twitterShareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl);

// Mở cửa sổ mới hoặc tab để chia sẻ nội dung lên Twitter
window.open(twitterShareUrl, '_blank');
}

</script>
@endsection
