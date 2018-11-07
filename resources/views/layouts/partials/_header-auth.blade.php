<div class="top-border"></div>
<nav id="navbar" class="navbar navbar-light navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand m--margin-right-10" href="{{ route('home') }}">
      <img src="{{ asset('img/logo.png') }}" class="mr-2" width="25" height="30">
      CODETUBE
    </a>

    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">
      <ul class="m--margin-left-15 navbar-nav mr-auto">
        <form id="search-form" class="form-inline" action="{{ route('search') }}" method="GET" autocomplete="off">
          <div class="m-input-icon m-input-icon--left">
            <input id="search-input" type="text" name="search_query" class="form-control m-input" placeholder="What will you watch next ?">
            <span class="m-input-icon__icon m-input-icon__icon--left">
              <span>
                <i class="flaticon-search-1" style="font-size: 1.2rem; padding-right: 5px;"></i>
              </span>
            </span>
          </div>
        </form>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="margin-top: 8px; margin-right: 30px;">
          <a href="{{ route('plans') }}" class="btn btn-focus m-btn m-btn m-btn--wide">
            Go premium
          </a>
        </li>

        <li class="nav-item m-dropdown m-dropdown--inline m-dropdown--small m-dropdown--arrow m-dropdown--align-right" data-dropdown-toggle="click">
          <a class="nav-link dropdown-toggle m-dropdown__toggle" href="#"> 
            <img src="{{ $user->channel()->first()->image }}" class="m--img-rounded mr-1 img-link avatar">
            Hi, {{ strtok($user->name, ' ') }}
          </a>

          <div class="m-dropdown__wrapper">
            <div class="m-dropdown__inner">
              <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                  <ul class="m-nav">
                    <li class="m-nav__item">
                      <a href="#" class="m-nav__link" data-toggle="modal" data-target="#upload-video-modal">
                        <i class="m-nav__link-icon flaticon-multimedia-1"></i>
                        <span class="m-nav__link-text">
                          Upload
                        </span>
                      </a>
                    </li>

                    <li class="m-nav__item">
                      <a href="/account/{{ '@' . $user->channelSlug() }}/profile" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-user"></i>
                        <span class="m-nav__link-title">
                          <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">
                              Account
                            </span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li class="m-nav__item">
                      <a href="/plans" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-gift"></i>
                        <span class="m-nav__link-title">
                          <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">
                              Premium
                            </span>
                          </span>
                        </span>
                      </a>
                    </li>

                    <li class="m-nav__separator m-nav__separator--dashed m-nav__separator--fit"></li>

                    <li class="m-nav__item">
                      <a href="/profile/{{ $user->channel()->first()->slug }}" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-imac"></i>
                        <span class="m-nav__link-text">
                          My videos
                        </span>
                      </a>
                    </li>

                    <li class="m-nav__item">
                      <a href="/account/{{ '@' . $user->channel()->first()->slug }}/settings" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-settings"></i>
                        <span class="m-nav__link-text">
                          Settings
                        </span>
                      </a>
                    </li>

                    <li class="m-nav__separator m-nav__separator--dashed m-nav__separator--fit"></li>

                    <li class="m-nav__item">
                      <a href="#" 
                        class="btn btn-outline-danger m-btn m-btn--wide btn-sm" 
                        onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();"
                      >
                        Sign out
                      </a>

                      <form id="sign-out-form" action="{{ route('logout') }}" class="m--hide" method="POST">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
