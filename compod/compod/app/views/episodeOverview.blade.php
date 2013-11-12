@extends('layouts.master')

@section('title')
@parent
 - Episode Overview
@stop

@section('content')
<h1>Showing {{$type}} episodes</h1>
    <?php
        if (strpos("$_SERVER[REQUEST_URI]",'user') !== false)
        {
            echo
            '<div class="container">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Sort
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="/compod/compod/server.php/recentuseroverview"><div class="glyphicon glyphicon-sort-by-order"></div> Newest</a></li>
                        <li><a href="/compod/compod/server.php/olduseroverview"><div class="glyphicon glyphicon-sort-by-order-alt"></div> Oldest</a></li>
                        <li><a href="/compod/compod/server.php/abcuseroverview"><div class="glyphicon glyphicon-sort-by-alphabet"></div> Abcdef...</a></li>
                        <li><a href="/compod/compod/server.php/zyxuseroverview"><div class="glyphicon glyphicon-sort-by-alphabet-alt"></div>  Zyxwvu...</a></li>
                    </ul>
                </div>
            </div>'
            ;
        }
        else
        {
            echo
            '<div class="container">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Sort
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="/compod/compod/server.php/recentoverview"><div class="glyphicon glyphicon-sort-by-order"></div> Newest</a></li>
                        <li><a href="/compod/compod/server.php/oldoverview"><div class="glyphicon glyphicon-sort-by-order-alt"></div> Oldest</a></li>
                        <li><a href="/compod/compod/server.php/abcoverview"><div class="glyphicon glyphicon-sort-by-alphabet"></div> Abcdef...</a></li>
                        <li><a href="/compod/compod/server.php/zyxoverview"><div class="glyphicon glyphicon-sort-by-alphabet-alt"></div>  Zyxwvu...</a></li>
                    </ul>
                </div>
            </div>'
            ;
        }
    ?>
<ul>
    @foreach($episodes as $episode)
    <li class="list-group-item" style="min-height:84px; margin-top:10px;">
        <div class="col-md-1">
            <a href="/compod/compod/server.php/episode/{{$episode->id}}">
                <img class="media-object" src="../public/img/episodelogos/{{ $episode->iconFile }}" alt="Episode icon" width="64" height="64">
            </a>
        </div>
        <div>
                <span class="pull-right"><a href="/compod/compod/server.php/podcast/{{$episode->podcast->podcast_id}}">{{$episode->podcast->name}}</a></span> 
                <a href="/compod/compod/server.php/episode/{{$episode->id}}"><b>{{$episode->title}}</b></a><br><em>{{$episode->publishdate}}</em><br>
                <p><em>{{$episode->description}}</em></p>    
            
        </div>
    </li>
  @endforeach
  <?php echo $episodes->links() ?>
</ul>
@stop
    