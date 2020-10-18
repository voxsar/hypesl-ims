<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactRelationship;
use App\Models\ContactRelationshipType;
use Illuminate\Http\Request;
use App\Http\Requests\RequestContact;
use Log;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::all();
        $data = array(
            'contacts' => $contacts, 
        );
        return view('contacts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $contacts = Contact::all();
        $contactrelationtypes = ContactRelationshipType::all();
        $data = array(
            'contacts' => $contacts,
            'contactrelationtypes' => $contactrelationtypes
        );
        return view("contacts.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestContact $request)
    {
        //
        $contact = new Contact();
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->oname = $request->oname;
        $contact->address = $request->address;
        $contact->mobile = $request->mobile;
        $contact->email = $request->email;
        $contact->street = $request->street;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->postal = $request->postal;
        $contact->type = $request->type;
        $contact->remarks = $request->remarks;
        $contact->organiation = $request->organiation;
        $contact->other = $request->other;

        $contact->password = '';

        //return $request;
        if($contact->save()){
            foreach ($request->relation_dynamic as $relation) {
                # code...
                $contactRelationship = new ContactRelationship();
                $contactRelationship->contact_id = $contact->id;
                $contactRelationship->related_contact_id = $relation['contact'];
                $contactRelationship->contact_relationship_type_id = $relation['type'];
                $contactRelationship->save();
            }
        }
        return redirect('contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        $data = array(
            'contact' => $contact, 
        );
        return view('contacts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        $data = array(
            'contact' => $contact, 
        );
        return view('contacts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(RequestContact $request, Contact $contact)
    {
        //
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->oname = $request->oname;
        $contact->address = $request->address;
        $contact->mobile = $request->mobile;
        $contact->email = $request->email;
        $contact->street = $request->street;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->postal = $request->postal;
        $contact->type = $request->type;
        $contact->remarks = $request->remarks;
        $contact->organiation = $request->organiation;
        $contact->other = $request->other;
        $contact->save();
        return redirect(url('contacts', $contact->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
