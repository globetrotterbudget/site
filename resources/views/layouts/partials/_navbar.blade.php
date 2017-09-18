<nav id="navbar" class="navbar navbar-default navbar-inverse">
     <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="logo" class="navbar-brand" href="{{ action('PageController@startover') }}"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li><a href="/auth/about">About Us</a></li>
                    @if(!Auth::check())
                    <li><a href="/auth/register">Sign Up</a></li>
                    <li><a href="/auth/login">Login</a></li>
                    @else
                    <li><a href="/trips">Trips</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="{{ action('UsersController@show', array(Auth::id()) ) }}">Update Account</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav> 
                    