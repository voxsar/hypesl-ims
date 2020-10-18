<?php

namespace App\Http\Controllers\API;


use App\Models\User;
use App\Models\Contact;
use App\Models\AppointmentType;
use App\Models\AppointmentColor;
use App\Models\AppointmentGroup;
use App\Models\AppointmentContact;
use App\Models\AppointmentConstraint;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Http\Resources\CalendarResource;
use Illuminate\Http\Request;
use Log;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CalendarResource::collection(Appointment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $appointment = new Appointment();
        $appointment->title = $request->title;
        $appointment->status = $request->status;
        $appointment->start = $request->start;
        $appointment->end = $request->end;

        $appointment->team_id = User::find($request->mentor)->currentTeam->id;
        $appointment->description = $request->description;
        $appointment->allday = $request->allday;

        $appointment->url = "selfurl";

        if($request->has('repeat_type') && $request->repeat_type != "No Repeat"){
            $appointment->starttime = $request->start;
            $appointment->endtime = $request->end;
            $appointment->startrecur = $request->start;
            $appointment->endrecur = $request->repeat_until;

            if(count($request->daysofweek) != 0){
                $appointment->daysofweek = $request->daysofweek;
            }
            $appointmentgroup = new AppointmentGroup();
            $appointmentgroup->save();
            $appointment->appointment_group_id = $appointmentgroup->id;
        }

        $appointment->editable = 1;
        $appointment->starteditable = 1;
        $appointment->durationeditable = 1;
        $appointment->resourceeditable = 1;

        $appointment->display = 'auto';
        $appointment->overlap = 0;
        $appointment->appointment_color_id = $request->backgroundcolor;
        $appointment->backgroundcolor = $request->backgroundcolor;
        $appointment->bordercolor = $request->backgroundcolor;
        $appointment->textcolor = "#000000";

        if($appointment->save()){
            if($request->has("contacts")){
                foreach ($request->contacts as $value) {
                    # code...
                    $appointmentcontact = new AppointmentContact();

                    $appointmentcontact->appointment_id = $appointment->id;
                    $appointmentcontact->contact_id = $value;

                    $appointmentcontact->save();
                }
            }
        }

        return new CalendarResource($appointment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //xc
        if($request->has('resize')){
            $appointment->start = Carbon::parse($request->resize['start']);
            if(array_key_exists('end', $request->resize)){
                $appointment->end = Carbon::parse($request->resize['end']);
                $appointment->allday = 0;
            }else{
                $appointment->end = Carbon::parse($request->resize['start']);
                $appointment->allday = 1;
            }
            $appointment->save();
            return response()->json($appointment);
        }elseif ($request->has('reschedule')) {
            # code...
            $appointment->start = Carbon::parse($request->reschedule['start']);
            if(array_key_exists('end', $request->reschedule)){
                $appointment->end = Carbon::parse($request->reschedule['end']);
                $appointment->allday = 0;
            }else{
                $appointment->end = Carbon::parse($request->reschedule['start']);
                $appointment->allday = 1;
            }
            $appointment->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
        $appointment->delete();
        return true;
    }
}
