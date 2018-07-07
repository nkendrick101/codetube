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
            <ul class="m--margin-left-45 navbar-nav mr-auto">
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
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-secondary m-btn m-btn--wide">
                        Sign in
                    </a>
                </li>
                <div class="header-vertical-separator m--margin-right-15"></div>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-focus m-btn m-btn--wide">
                        Sign up
                    </a>
                </li>
       		</ul>
       </div>
    </div>
</nav>