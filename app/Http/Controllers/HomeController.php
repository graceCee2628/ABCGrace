<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
use App\Comment;
use App\Log;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*TO LOAD THE ADMIN DASH BOARD*/

    public function index()
    {
     
        $tickets =DB::table('tickets')
                ->where('status', 'open')
                ->orwhere('status', 're-open')
                ->get();

        return view('admin.index')->with('tickets', $tickets);
    }

    public function tickets(Request $request, $id)
    {
        
        $ticket = Ticket::find($id);
        $ticket->status =$request->input('status');
        $ticket->user_id =auth()->user()->id; 
        $ticket->save();

        $comment = new comment;
        $comment->comments =$request->comment; 
        $comment->ticket_id = $id;
        $comment->name =auth()->user()->name; 
        $comment->save();

        $log = new log;
        $log->ticket_id= $id;
        $log->name= auth()->user()->name;
        $log->status=$request->input('status');
        $log->save();        


        return $id ;
       
    }

    public function show()
    {
        $tickets =DB::table('tickets')
                ->where('status', 'pending')
                ->orwhere('status', 'returned')
                ->orwhere('status', 'resolved')
                ->get();
        
        return view('admin.treated_tickets')->with('tickets', $tickets);
    }

    public function viewticket($id)
    {

        $tickets = Ticket::with('comments')->find($id);
     
        return view ('admin.view')->with('tickets', $tickets);

    }
    public function closed()
    {
        $tickets =DB::table('tickets')
                ->where('status', 'close')
                ->get();
        return view('admin.closed')->with('tickets', $tickets);
    }
    public function logs($id)
    {
         $logs=Log::with('tickets')->find($id); 

         return view ('admin.logs')->with('logs',$logs );
    }
}
