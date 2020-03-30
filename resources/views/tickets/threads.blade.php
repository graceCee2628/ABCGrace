@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-3">
           @include('inc.sidebar')
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h2>
                            <label></label>&nbsp
                        </h2>
                        <h2 id="id">{{$tickets->code}}</h2>
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
                                <label name="comment">You:</label>
                                <textarea name="comment" class="form-control" id="comment" placeholder="Place your comments here..."></textarea>
                                    
                            </div>  

                        </div>
                    
                     
                        <div class="modal-footer">
                       
                            <button type="submit" class="btn btn-primary" class="submit">Submit</button>
                            <a href="/home" class="btn btn-secondary btnBack">Back</a>
                        </div>
                    
                    </form>                    

                  </div>

                </div>
                
            </div>

        </div>
     </div>

     <script type="text/javascript">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });  

           $('#UpdateForm').on('submit', function(e){
              e.preventDefault();
              var id = $('#id').text();
              var comment = $('#comment').val();
           


               $.ajax({
                      url:'/my_ticket/'+id+'/update',
                      method:'POST',
                      data:{
                          id:id,
                          comment:comment

                      },
                      success:function(response){
                        /*console.log(response);
                        window.location.assign('/home');*/
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