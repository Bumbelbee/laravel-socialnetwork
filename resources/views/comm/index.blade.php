@extends('layouts.app')

@section('content')
    <div class="h-20"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.sidebar')
            </div>
            <div class="col-md-9">
                @include('flash')
                <div class="content-page-title">
                    <i class="fa fa-users"></i> Communities
                        <div class="green">
                            <a href="javascript:;" data-toggle="modal" data-target="#group">
                            <i class="fa fa-pencil"></i>Create Community</a>
                        </div>
                </div>

    {{-- group creation modal window --}}
    <div class="modal fade" id="group" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">Create community</h3>
                </div>
                <form id="form-profile-hobbies" method="post" action="">

                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label>Title:</label>
                            <input type="text" class = 'form-control' placeholder="community title" name = 'title'>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                            <input type="text" name = 'desc' class = 'form-control' placeholder="community description">
                            <input type="hidden" name = 'creator' value="{{$user->name}}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- end of modal window of group creation --}}
    
{{-- my community list --}}
    @foreach($community as $comm)
    <div class="list-group col-md-5 text-center">
    <p class="list-group-item list-group-item-action active ">My list of communities</p>
  <a href="community/{{$comm->title}}" class="list-group-item list-group-item-action">{{$comm->title}}</a>
</div>
@endforeach
{{-- not in community --}}
<table class="table table-sm table-bordered">
  <thead class="bg-primary">
    <tr >
    <th scope="col" class="col-sm-3">Title</th>
      <th scope="col">Description</th>
      <th scope="col"
      class="col-sm-1">Follow</th>
    </tr>
  </thead>
  <tbody>
  @foreach($allow as $allo)
@if($allo->allow == 0)
@foreach($community as $comm)
    <tr class="table-primary">
      <td>{{$comm->title}}</td>
      <td >{{$comm->description}}</td>
      <td>                  @foreach($allow as $allo)@endforeach
                            <form action="/commfollow" method="get">
                            <button class="btn btn-primary">follow</button>
                            <input type="hidden" name="title" value="{{$comm->title}}">
                            <input type="hidden" name="commId" value="{{$comm->id}}">
                            <input type="hidden" name="userId" value="{{$user->id}}">
                            </form>
                      </td>

    </tr>
  @endforeach
  @endif
  @endforeach
 </tbody>
</table>


            </div>
        </div>
    </div>


@endsection

@section('footer')

@endsection