<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Ticket;
use App\User;
Use App\Comment;
Use App\Log;

class TicketsController extends Controller
{


    public function __construct()
    {
    
        $this->middleware('auth');
    }

    public function index()
    {

        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        return view ('home')->with('tickets', $user->tickets); 
    }

    
    public function create()
    {
        return view ('tickets.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'priority' => 'required',
            'description'=> 'required'
        ]);

        $ticket = new Ticket;
        $date = preg_replace("/[\s-:]/", "", $request->created_at);
        $priority = $request->input('priority');

        $ticket->code = 'CODE:'.$date.$priority;

        $ticket->title =$request->input('title');
        $ticket->priority =$request->input('priority');
        $ticket->body =$request->input('description');
        $ticket->status ='open';
        $ticket->user_id =auth()->user()->id; 
        $ticket->save();

        $log = new log;
        $ticket = Ticket::orderBy('created_at', 'desc')->first();
        $log->ticket_id= $ticket->id;
        $log->name= auth()->user()->name;
        $log->status='open';
        $log->save();


        return redirect('/tickets')->with('success', 'Tickets Created');

    }

   
    public function show($id)
    {
        $tickets = Ticket::find($id); 

        return view ('tickets.show')->with('tickets', $tickets);

    }

    
    public function edit($id)
    {
        $tickets = Ticket::find($id);

        if(auth()->user()->id !==$tickets->user_id){
            return redirect ('/tickets')->with('error', 'Unauthorized Page!');
        }
        
        return view ('tickets.edit')->with('tickets', $tickets);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'priority' => 'required',
            'description'=> 'required'
        ]);

        $ticket = Ticket::find($id);
        $ticket->title =$request->input('title');
        $ticket->priority =$request->input('priority');
        $ticket->body =$request->input('description');
        $ticket->status ='open';
        $ticket->user_id =auth()->user()->id; 
        $ticket->save();

        $log = new log;
        $log->ticket_id= $id;
        $log->name= auth()->user()->name;
        $log->status='open';
        $log->save();

        return redirect('/tickets')->with('success', 'Ticket Updated');
    }

    
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if(auth()->user()->id !==$ticket->user_id){
            return redirect ('/tickets')->with('error', 'Unauthorized Page!');
        }        
        $ticket->delete();
        return redirect('/tickets')->with('success', 'Ticket Removed!');
    }

    public function threads($id)
    {

        $tickets = Ticket::with('comments')->find($id);
        return view ('tickets.threads')->with('tickets',$tickets);
    }

    public function threads_update(Request $request, $id)
    {

        $comment = new comment;
        $comment->comments =$request->comment; 
        $comment->ticket_id = $id;
        $comment->name =auth()->user()->name; 
        $comment->save();
    }    


}
