@extends('layouts.app')

@section('content')



    <div class="row justify-content-center">

        <div class="col-md-3">
            @include('admin._sidebar')
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">

                    <h2>Open Tickets</h2>
                </div>

                <div class="card-body">
                    @if(count($tickets)>0)
                    
                    <table class="table table-sm table-info table-striped">
                        <thead class="thead">
                          <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($tickets as $ticket)
                          <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->code}}</td>
                            <td>{{$ticket->title}}</td>
                            <td>{{$ticket->body}}</td>
                            <td>{{$ticket->priority}}</td>
                            <td>{{$ticket->status}}</td>
                            <td>{{$ticket->created_at}}</td>
                            <td>
                               <a href="#" class="btn btn-primary btn-sm btnaccept " id="acceptbtn">Accept</a> 
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
                            <!--<label class="text-primary">Ticket ID:</label>-->
                            <label class="text-primary" id="code"></label>
                            <label type="hidden" class="text-primary" id="id"></label>
                            
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
                                            <label name="category">Category:</label>
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
                                            <label name="description">Description:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label id="description"></label>
                                        </div>                                
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="status">Status:</label>
                                        </div>
                                        <div class="col-md-6">                                            
                                            <select id="status" class="form-control">
                                              <option></option>
                                              <option>Open</option>
                                              <option>Pending</option>
                                              <option>Resolved</option>
                                            </select>
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
                            <button type="submit" class="btn btn-primary" class="submit">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    
                    </form>

              </div>

            </div>

        </div>

    <script type="text/javascript">

        /*
        |--------------------------------------------------------------------------
        | TO FETCH THE DATA FROM THE TABLE TO THE MODAL
        |--------------------------------------------------------------------------
        */        
        
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    

           $('.btnaccept').on('click', function(){
              $('#myModal').modal('show');

              var tr = $(this).closest('tr');
              var data = tr.children('td').map(function(){
                return $(this).text();
              }).get();

              console.log(data);

              $('#id').text(data[0]);
              $('#code').text(data[1]);
              $('#category').text(data[2]);              
              $('#description').text(data[3]);  
              $('#priority').text(data[4]);
              $('#status').val(data[5]);
              $('#date').text(data[6]);
           });

        /*
        |--------------------------------------------------------------------------
        | TO UPDATE THE DATA FROM THE TABLE TO THE MODAL
        |--------------------------------------------------------------------------
        */ 
        
           $('#UpdateForm').on('submit', function(e){
              e.preventDefault();
              var id = $('#id').text();
              var title = $('#title').text();
              var description =  $('#description').text();
              var priority = $('#priority').text();
              var status = $('#status').val();
              var comment = $('#comment').val();
               $.ajax({
                      url:'/admin/'+id+'/tickets',
                      method:'POST',
                      data:{
                          id,
                          title,
                          description,
                          priority,
                          status,
                          comment

                      },
                      success:function(response){
                        console.log(response);
                        window.location.assign('/admin/' + response + '/treated_tickets');

                      },
                      error:function(error){
                        console.log(error); 
                      }
               });

           });

 

        });


    </script>

@endsection
