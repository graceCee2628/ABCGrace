@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-3">
            @include('admin._sidebar')
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">

                    <h2>Closed Tickets</h2>
                </div>

                <div class="card-body">
                   
                    @if(count($tickets)>0)
                    
                    <table class="table table-sm table-info table-striped">
                        <thead class="thead">
                          <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($tickets as $ticket)
                          <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->title}}</td>
                            <td>{{$ticket->body}}</td>
                            <td>{{$ticket->priority}}</td>
                            <td>{{$ticket->status}}</td>
                            <td>{{$ticket->created_at}}</td>
                            <td>
                               <a href="/admin/{{$ticket->id}}/view_ticket" class="btn btn-primary btn-sm view " id="{{$ticket->id}}">View</a> 
                            </td>
                            <td>
                               <a href="#" class="btn btn-secondary btn-sm logs " id="acceptbtn">Logs</a> 
                            </td>
                        
                          </tr>
                           @endforeach
                        </tbody>
                  </table>
                  @endif
                </div>
                
            </div>

        </div>
     </div> 
@endsection