<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\AppointmentColor;
use App\Models\AppointmentGroup;
use App\Models\AppointmentContact;
use App\Models\AppointmentConstraint;
use Illuminate\Http\Request;
use App\Http\Requests\RequestAppointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $contacts = Contact::all();
        $appointmenttypes = AppointmentType::all();
        $appointmentcolors = AppointmentColor::all();
        $appointmentconstraints = AppointmentConstraint::all();
        $past = Appointment::where('start', '<', Carbon::now())->count();
        $future = Appointment::where('start', '>=', Carbon::now())->count();
        $pending = Appointment::where('status', 'Pending')->count();
        $total = Appointment::count();
        $data = array(
            'users' => $users,
            'contacts' => $contacts,
            'appointmenttypes' => $appointmenttypes,
            'appointmentcolors' => $appointmentcolors,
            'appointmentconstraints' => $appointmentconstraints,
            'past' => $past,
            'future' => $future,
            'pending' => $pending,
            'total' => $total,
        );
        return view('events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $contacts = Contact::all();
        $appointmenttypes = AppointmentType::all();
        $appointmentcolors = AppointmentColor::all();
        $appointmentconstraints = AppointmentConstraint::all();
        $data = array(
            'users' => $users,
            'contacts' => $contacts,
            'appointmenttypes' => $appointmenttypes,
            'appointmentcolors' => $appointmentcolors,
            'appointmentconstraints' => $appointmentconstraints,
        );
        return view('events.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestAppointment $request)
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

        if($request->url){
            $appointment->url = $request->url;
        }else{
            $appointment->url = "selfurl";
        }

        if($request->has('repeat_until')){
            $appointment->starttime = $request->start;
            $appointment->endtime = $request->end;
            $appointment->startrecur = $request->start;
            $appointment->endrecur = $request->repeat_until;
            if($request->daysofweek->count() != 0){
                $appointment->daysofweek = $request->daysofweek;
            }
            $appointmentgroup = new AppointmentGroup();
            $appointmentgroup->save();
            $appointment->appointment_group_id = $appointmentgroup->id;
        }

        $appointment->editable = 1;
        $appointment->starteditable = $request->starteditable;
        $appointment->durationeditable = $request->durationeditable;
        $appointment->resourceeditable = $request->resourceeditable;

        $appointment->display = $request->display;
        $appointment->overlap = $request->overlap;
        $appointment->appointment_color_id = $request->backgroundcolor;
        $appointment->backgroundcolor = $request->backgroundcolor;
        $appointment->bordercolor = $request->bordercolor;
        $appointment->textcolor = $request->textcolor;
        $appointment->extendedprops = $request->appointment_additional;

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
        return redirect('appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
        //return 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
