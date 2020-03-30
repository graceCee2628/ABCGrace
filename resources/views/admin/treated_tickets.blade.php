@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-3">
            @include('admin._sidebar')
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">

                    <h2>Treated Tickets</h2>
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
                               <a href="/admin/{{$ticket->id}}/viewlogs" class="btn btn-secondary btn-sm logs " id="{{$ticket->id}}">Logs</a> 
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


<!--------------------------------------------------------------------------
                       MODAL FORM
---------------------------------------------------------------------------->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
              <div class="modal-content">
              
                    <!-- Modal Header -->
                    <div class="modal-header" >
                        <h4 class="modal-title" >
                            <label class="text-primary">Ticket ID:</label>
                            <label class="text-primary" id="id"></label>
                            
                        </h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form id="UpdateForm">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="date">Date Created:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label  id="date"></label>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="category">:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label  id="category"></label>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="priority">Priority:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label id="priority"></label>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="status">Status:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label id="status"></label>
                                        </div>                                
                                    </div>                            
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="description">Description:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label name="description" id="description"></label>
                                        </div>                                
                                    </div>
                                    
                            </div>
                            <div class="form-group">
                                <label name="comment">Comments:</label>
                                <textarea name="comment" class="form-control" id="comment" placeholder="Place your comments here..."></textarea>
                                    
                            </div>  
                        </div>
                    
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!--   {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}-->
                            <button type="submit" class="btn btn-primary" class="submit">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    
                    </form>

              </div>

            </div>

        </div>
<!--------------------------------------------------------------------------
                       END MODAL FORM
---------------------------------------------------------------------------->








<script type="text/javascript">
    
       /* $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


           $('.logs').on('click', function(e){
              e.preventDefault();
            //  $('#myModal').modal('show');
              var id = this.id;
              $.ajax({
                      url:'/admin/'+id+'/viewlogs',
                      method:'GET',
                      data:{
                          id

                      },
                      success:function(response){
                        console.log(response[i].fieldname);
                        //window.location.assign('/admin/' + response + '/treated_tickets');

                      },
                      error:function(error){
                        console.log(error); 
                      }                

              });
        




                

            });

        }); */ 

</script>    

@endsection