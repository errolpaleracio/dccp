<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Document;
use App\Models\Request as Req;
use App\Models\Transaction as Trans;
use App\Models\User;
use DB;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $trans = Trans::where('user_id', auth()->user()->id)->with('Request')->paginate(5);
        
        return view ('request.index')
        ->with('transactions', $trans)
        ->with('i', ($request->input('page', 1) - 1) * 5);
        // ->with('total_amount', $total_amount);

        // $paginated_requests = Req::where('user_id', auth()->user()->id)->paginate(5)
        // ->where('status', '<>', 'Pending');
        // $total_amount = DB::table('requests')
        //     ->select([DB::raw("SUM(price * copies) as total_amount")])
        //     ->where('user_id', auth()->user()->id)
        //     ->first()->total_amount;

        // return view ('request.index')
        //     ->with('requests', $paginated_requests)
        //     ->with('i', ($request->input('page', 1) - 1) * 5)
        //     ->with('total_amount', $total_amount);
    }

    public function create()
    { 
        $documents = Document::all();
        $courses = Course::pluck('description', 'description')->all();
        
        return view('request.add_request')
        ->with('courses', $courses)
        ->with('documents', $documents);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'documents' => ['required'],
            'remarks' => ['required']
        ]);
        
        $documents = $request->documents;
        $copies = $request->copies;
        $remarks = $request->remarks[0];

        $trans_id = Trans::create([
            'remarks' => $remarks,
            'user_id' => auth()->user()->id
        ])->id;

        for($i = 0; $i < count($documents); $i++)
        {
            $price = Document::where('description', $documents[$i])->first()->price;
            Req::create([
                'document' => $documents[$i],
                'copies' => $copies[$i],
                'price' => $price,
                'transaction_id' => $trans_id
            ]);
        }

        return redirect()->route('all_request')->with('success', 'You successfully sumitted the request!');
    }

    public function view_request(Request $request)
    {
        $trans = Trans::with('Request')
        ->with('User')
        ->orderBy('id', 'desc')->paginate(5);
        return view ('request.view_request')
            ->with('transactions', $trans)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function update_status(Request $request, $trans_id)
    {
        $test ='';
        $trans = Trans::find($trans_id);
        if($request->status == 'Approved')
            $trans->update([
                'status' => $request->status,
                'claim_date' => $request->claim_date
            ]);
        else if($request->status == 'Disapproved')
            $trans->update([
                'status' => $request->status,
                'reason' => $request->reason[0]
            ]);
        else if($request->status == 'Claimed'){
            $test = 'testing';
            $trans->update([
                'receipt_no' => $request->receipt_no,
                'released_by' => $request->released_by,
                'claimed_by' => $request->claimed_by,
                'date_claimed' => $request->date_claimed,
                'status' => $request->status
            ]);
            }
        else
            $trans->update([
                'status' => $request->status,
                'reason' => $request->reason
            ]);
        
        $user = User::find(auth()->user()->id);
        if($user->hasRole('registrar'))
            return redirect()->route('view_request')->with('success', 'You successfully approved the request!');
        return redirect()->route('all_request')->with('success', 'You successfully approved the request!');
    }
}