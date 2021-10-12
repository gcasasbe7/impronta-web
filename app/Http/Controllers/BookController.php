<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('user')->get();
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'numPeople' => 'required',
            'bookDate' => 'required',
            'state' => 'required',
        ]);

        Book::create($request->all());

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'numPeople' => 'required',
            'bookDate' => 'required',
            'state' => 'required',
        ]);

        Book::find($id)->update($request->all());
    }

    public function updateState(Request $request, $id)
    {
        $state = $request->input('state');

        Book::find($id)->update(['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
    }

    public function getBooks(){
        $books = Book::where('user_id',Auth::user()->id)->whereDate('bookDate','>',Carbon::now()->subDay())->get();

        $data = array(
            "books" => $books,
        );
        $response = response()->json($data,200);
        return $response;
    }



    public function generateBook(Request $request){
        $date = $request->input('date');
        $hour = $request->input('hour');
        $admin = $request->input('admin');
        $numPersons = $request->input('numPersons');

        $day = substr($date, 0,2);
        $month = substr($date, 3, 2);
        $year = substr($date, -4);

        $booktime = $date . ' ' . $hour;

        $format = 'd/m/Y H:i';
        $datetime = DateTime::createFromFormat($format, $booktime);

        $result = false;

        $carbonDate = $year . "-" . $month . "-" . $day . " " . $hour;


        if(Carbon::parse($carbonDate)->gte(Carbon::now()->addHours(2))){
            $book = new Book;
            $book->numPeople = $numPersons;
            $book->bookDate = $datetime;
            $book->user_id = Auth::user()->id;
            if($admin){
                $book->state = "Confirmada";
            }else{
                $book->state = "Pendiente de confirmación";
            }

            $book->save();
            $result = true;
        }

        $data = array(
            "result" => $result,
        );
        $response = response()->json($data,200);
        return $response;
    }
}
