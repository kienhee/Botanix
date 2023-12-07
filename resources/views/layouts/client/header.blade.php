<header class="header">
    <nav class="container header__nav">
        <ion-icon name="menu-outline" class="icon-menu-mobile header__icon-mobile"></ion-icon>

        <div class="header__nav-features">
            <a href="/" class="header__logo">
                <img src="{{ asset('client') }}/assets/images/logo.png" class="header__logo-image" alt="" />
                <span class="header__logo-name">Base Universe</span>
            </a>
            <ul id="header__list" class="header__list">
                <li class="header__list-item-mobile">
                    <a href="/">
                        <img src="{{ asset('client') }}/assets/images/logo.png" alt="" />
                    </a>
                    <ion-icon class="icon-menu-mobile" name="close-outline" class="header__list-item-mobile-close">
                    </ion-icon>
                </li>
                <li
                    class="header__list-item {{ url()->current() == route('client.project') ? 'header__list-item-active' : '' }} ">
                    <a href="{{ route('client.project') }}" class="header__list-link">Projects</a>
                </li>
                <li
                    class="header__list-item {{ url()->current() == route('client.submit') ? 'header__list-item-active' : '' }} ">
                    <a href="{{ route('client.submit') }}" class="header__list-link">Submit</a>
                </li>
                <li class="header__list-item">
                    <a href="#" class="header__list-link">For Builder</a>
                </li>
                <li class="header__list-item">
                    <a href="#" class="header__list-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                        <span>Twitter</span>
                    </a>
                </li>
            </ul>
        </div>
        <form action="{{route('client.project')}}" class="header__search">
            <ion-icon name="search-outline"></ion-icon>
            <input type="text" name="keywords" value="{{request('keywords')}}" placeholder="Search projects " />
        </form>
    </nav>
</header>