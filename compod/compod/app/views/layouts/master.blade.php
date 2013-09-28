<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            Community Podcast
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
        <!-- CSS are placed here -->
        {{ HTML::style('../public/css/bootstrap.css') }}
        {{ HTML::style('../public/css/bootstrap-responsive.css') }}
        {{ HTML::style('../public/css/bootstrap-theme.css') }}
        {{ HTML::style('../public/skin/jplayer.blue.monday.css') }}

        <style>
        @section('styles')
            body {
                padding-top: 60px;
            }
        @show
        </style>
        
        <!-- Script imports are placed here -->
        {{ HTML::script('../public/js/jquery-1.10.2.min.js') }}
        {{ HTML::script('../public/js/bootstrap.min.js') }}
        {{ HTML::script('../public/js/jquery.jplayer.min.js') }}
        
        <!-- Scripts section can be used in blade templates -->
        <script type="text/javascript">
        @yield('scripts')
        </script>
    </head>

    <body>
        <!-- Navbar -->
        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/compod/compod/server.php">Community Podcast</a>
            </div>
          
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav">
                @if (Auth::check())
                <li><a href="/compod/compod/server.php/podcastoverview">Podcasts</a></li>
                <li><a href="/compod/compod/server.php/episodeoverview">Episodes</a></li>
                @endif
                <li class="dropdown">
                  
                </li>
              </ul>
              @if (Auth::check())
              {{ Form::open(array('class'=>'navbar-form navbar-left','url' => 'searchpodcast', 'method' => 'post')) }}
                <div class="form-group">
                  {{ Form::text('search', Input::old('searchinput'), array('class' => 'form-control', 'placeholder' => 'Search podcast')) }}
                </div>
                {{ Form::submit('Search', array('class' => 'btn btn-default')) }}
              {{ Form::close() }}
              @endif
              <ul class="nav navbar-nav navbar-right">
                  @if (Auth::check())
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="/compod/compod/server.php/podcastoverviewforuser">My podcasts</a></li>
                          <li><a href="/compod/compod/server.php/episodeoverviewforuser">My episodes</a></li>
                          <li class="divider"></li>
                          <li><a href="/compod/compod/server.php/user">Account Settings</a></li>
                          <li><a href="/compod/compod/server.php/logout">Logout</a></li>
                        </ul>
                  </li>
                   @endif
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav>
        
        <!-- Container -->
        <div class="container">

            <!-- Content -->
            @yield('content')

        </div>
        
        <!-- Footer -->
        <div class="container">
            <hr>
            <footer>
                <p>&copy; Idipsum 2013</p>
            </footer>
        </div>
    </body>
</html>