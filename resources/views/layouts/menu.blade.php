<header class="header">
    <div class="menu">
    
        <div class="logo">
            <!--Logo-->
            <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>
        <!-- if user is not authenticated -->
        @guest
        <ul class="d-flex">
            <li class="me-2"><a href="{{ route('login') }}" class="login">Go into</a></li>
            <li><a href="{{ route('register') }}" class="create">Create account</a></li>
        </ul>
        <!-- if user is authenticated -->
        @else
        <div class="dropdown">
            <div class="dropdown-btn">
                <div >
                    <a class="btn dropdown-toggle" href="{{ route('profiles.show', ['profile'=> Auth::user()->id]) }}" role="button" id="dropdownMenuLink" 
                    data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="{{ Auth::user()->profile->photo ? asset('storage/' . Auth::user()->profile->photo) 
                        : asset('img/user-default.png') }}" alt="Profile" class="img-profile">
                
                        
                    </a>
                </div>
                <div class="name-user"><a class="btn dropdown-toggle" href="{{ route('profiles.show', ['profile'=> Auth::user()->id]) }}" role="button" id="dropdownMenuLink" 
                    data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->full_name }}</a></div>
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <!-- &#x25B2; triangle upword-->
                <li class="arrow">&#x25BC;</li>
                <div>
                <li><a class="dropdown-item"
                        href="{{ route('profiles.edit', ['profile'=> Auth::user()->id]) }}">Edit profile</a></li>

                <li><a class="dropdown-item"
                        href="{{ route('profiles.show', ['profile'=> Auth::user()->id]) }}">See profile</a></li>
                @can('admin.index')
                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Go to admin</a></li>
                @endcan
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">Go out</a>
                </li>
                </div>
            </ul>
        </div>
        @endguest
    </div>

</header>