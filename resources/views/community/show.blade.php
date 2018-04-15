@extends('layouts.app')
@section('content')
    <div class="h-20"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="content-page-title">
                    <i class="fa fa-users" >
                        @foreach($community as $comm)
                        {{$comm->title}}
                        @endforeach
                    </i>
                </div>
                    @include('flash')
            </div>

        </div>
                {{-- posts wall --}}
                    
                <div class="row">
                   
            <div class="col-md-3">
                @include('widgets.menu')
            </div>
                    <div class="col-xs-12 col-md-3 pull-right">
                        <div class="hidden-sm hidden-xs">
                           <div class="panel panel-default">
                                <div class="panel-heading">Creator</div>
                                <li class="list-group-item"><a href='/{{$comm->creator}}'>{{$comm->creator}}</a></li>
                            </div>

                            <div class="panel panel-default">  
                                <div class="panel-heading">Created at</div>
                                    <li class="list-group-item">{{$comm->created_at}}</li>
                                </div>
                                <div class="panel panel-default"> 

                                <div class="panel-heading">{{$comm->followers}} people following us
                                  {{-- follow condition   --}}
                                        @if ($user->name != $comm->creator)
                                            <form action="/communfollow" method="get">
                                            <button class="btn btn-primary">unfollow</button>
                                            <input type="hidden" name="title" value="{{$comm->title}}">
                                            <input type="hidden" name="commId" value="{{$comm->id}}">
                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                            </form>
                                        @endif
                                       </div>
                                </div>
                            </div>
                        </div>
                   <div class="col-md-6">
                        @include('widgets.wall')
                    </div>
                </div>
                    </div>

@endsection

@section('footer')
    <script type="text/javascript">
            WALL_ACTIVE = true;
            fetchPost(1,0,{{ $user->id }},5,-1,-1,'initialize');
   </script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection