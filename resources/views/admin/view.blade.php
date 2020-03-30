@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-3">
            @include('admin._sidebar')
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h2>
                            <label>Ticket#:</label>&nbsp
                        </h2>
                        <h2 id="id">{{$tickets->id}}</h2>
                    </div>
                </div>

                <div class="card-body">
                  <div>
                    <form id="UpdateForm">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="date">Date Created:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label  id="date">{{$tickets->created_at}}</label>
                                        </div>   
                                        <div class="col-md-3">
                                            <b>
                                                <label id="statuschange" class="text-danger">Action:</label>
                                            </b>
                                        </div>  
                                        <div class="col-md-3" >
                                            <select class="form-control text-danger" id="status">
                                                <option class="text-danger"></option>
                                                <option class="text-danger">Re-open</option>
                                                <option class="text-danger">Close</option>
                                                <option class="text-danger">Pending</option>
                                                <option class="text-danger">Resolved</option>
                                            </select>
                                        </div> 

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="title">Category:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label  id="title">{{$tickets->title}}</label>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="priority">Priority:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label id="priority">{{$tickets->priority}}</label>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="status">Status:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label id="status1">{{$tickets->status}}</label>
                                        </div>  
                                                                                                            
                                    </div>                            
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label name="description">Description:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <label name="description" id="description">{{$tickets->body}}</label>
                                        </div>                                
                                    </div>

                                    
                            </div>
                            <hr>
                            <div class="form-group">
                                <label name="comment">Comments:</label>
                                <div class="col-md-9 mt-2" >

                                  @foreach($tickets->comments as $comment)



                                  <table>
                                    
                                      <tr>
                                        <label class="text-primary">{{$comment->name}} :&nbsp</label>
                                          {{$comment->comments}}
                                      </tr>

                                  </table>
                                  
                                    <label name="comment"></label>
                                  @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="comment">Admin:</label>
                                <textarea name="comment" class="form-control" id="comment" placeholder="Place your comments here..."></textarea>
                                    
                            </div>  

                        </div>
                    
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <!--   {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}-->
                            <button type="submit" class="btn btn-primary" class="submit">Submit</button>
                            <a href="/admin/{id}/treated_tickets" class="btn btn-secondary btnBack">Back</a>
                        </div>
                    
                    </form>                    

                  </div>



                </div>
                
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

           $('#UpdateForm').on('submit', function(e){
              e.preventDefault();
              var id = $('#id').text();
              var title = $('#title').text();
              var description =  $('#description').text();
              var priority = $('#priority').text();
              var status = $('#status').val();
              var comment = $('#comment').val();
              //alert(comment);


               $.ajax({
                      url:'/admin/'+id+'/tickets',
                      method:'POST',
                      data:{
                          id:id,
                          title:title,
                          description:description,
                          priority:priority,
                          status:status,
                          comment:comment

                      },
                      success:function(response){
                        /*console.log(response);
                        window.location.assign('/admin/' + response + '/treated_tickets');*/
                        location.reload();

                      },
                      error:function(error){
                        console.log(error); 
                      }
               });


           });              


        });


    </script> 




@endsection    



