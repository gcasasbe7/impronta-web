<?php

namespace App\Http\Controllers;

use App\Mail\PromotionEmail;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return $events;
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
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        Event::create($request->all());

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
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        Event::find($id)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
    }

    public function generateEvent(Request $request){
        $start_date = $request->input('start_date');
        $start_hour = $request->input('start_hour');
        $end_date = $request->input('end_date');
        $end_hour = $request->input('end_hour');
        $title = $request->input('title');
        $description = $request->input('description');
        $photo = $request->input('photo');


        $timestart = $start_date . ' ' . $start_hour;
        $timeend = $end_date . ' ' . $end_hour;


        $format = 'd/m/Y H:i';

        $datetimestart = DateTime::createFromFormat($format, $timestart);
        $datetimeend = DateTime::createFromFormat($format, $timeend);



        $event = new Event;
        $event->title = $title;
        $event->description = $description;
        $event->photo = $photo;
        $event->start_date = $datetimestart;
        $event->end_date = $datetimeend;

        $event->save();

    }

    public function generatePromotion(Request $request){
        $title = $request->input('title');
        $date = $request->input('date');
        $body = $request->input('body');

        $users = User::where('recievePromotions',1)->get();

        foreach($users as $user){
            Mail::to($user->email)->send(new PromotionEmail($user,$title,$date,$body));
        }
    }
}
