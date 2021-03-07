<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Document;
use App\Models\Request as Req;
use DB;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $paginated_requests = Req::where('user_id', auth()->user()->id)->paginate(5);
        $total_amount = DB::table('requests')
            ->select([DB::raw("SUM(price * copies) as total_amount")])
            ->where('user_id', auth()->user()->id)
            ->first()->total_amount;

        return view ('request.index')
            ->with('requests', $paginated_requests)
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('total_amount', $total_amount);
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
        $studies = $request->studies[0];
        $remarks = $request->remarks[0];

        for($i = 0; $i < count($documents); $i++)
        {
            $price = Document::where('description', $documents[$i])->first()->price;
            Req::create([
                'document' => $documents[$i],
                'copies' => $copies[$i],
                'price' => $price,
                'remarks' => $remarks,
                'user_id' => auth()->user()->id 
            ]);
        }

        return redirect()->route('all_request')->with('success', 'You sucessfully sumitted the request!');
    }
}
