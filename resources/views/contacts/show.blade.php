@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Contact" />
	<div class="row">
	    <div class="col-md-12">
			<div class="card">
				<div class="card-header">Details</div>
				<div class="card-body">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
	                    <li class="nav-item"><a class="nav-link active" id="home-basic-tab" data-toggle="tab" href="#homeBasic" role="tab" aria-controls="homeBasic" aria-selected="true">Details</a></li>
	                    <li class="nav-item"><a class="nav-link" id="profile-basic-tab" data-toggle="tab" href="#profileBasic" role="tab" aria-controls="profileBasic" aria-selected="false">Invoices</a></li>
	                    <li class="nav-item"><a class="nav-link" id="contact-basic-tab" data-toggle="tab" href="#contactBasic" role="tab" aria-controls="contactBasic" aria-selected="false">Additional Contacts</a></li>
	                </ul>
	                <div class="tab-content" id="myTabContent">
	                    <div class="tab-pane fade show active" id="homeBasic" role="tabpanel" aria-labelledby="home-basic-tab">
	                        <div class="row">
							    <div class="col-md-6">
							    	<x-input name="fname" label="First Name" value="{{$contact->fname}}"/>
							    	<x-input name="lname" label="Last Name" value="{{$contact->lname}}"/>
							    	<x-input name="oname" label="Other Name" value="{{$contact->oname}}"/>
							    	<x-input name="mobile" label="Mobile" value="{{$contact->mobile}}"/>
							    	<x-input name="email" label="Email" value="{{$contact->email}}"/>
							    	<x-input name="street" label="Street" value="{{$contact->street}}"/>
							    	<x-input name="city" label="City" value="{{$contact->city}}"/>
							    </div>
							    <div class="col-md-6">
							    	<x-input name="postal" label="Postal" value="{{$contact->postal}}"/>
							    	<x-input-dynamic name="other" label="Other Details" :value="$contact->other"/>
							    	<x-select2 name="type" label="Type">
							    		<x-slot name="options">
							    			<option value="child">Child</option>
							    			<option value="parent">Parent</option>
							    			<option value="guardian">Guardian</option>
							    			<option value="teacher">Teacher</option>
							    		</x-slot>
							    	</x-select2>
							    </div>
							</div>
							<div class="row">
							    <div class="col-md-12">
							    	<x-area name="remarks" label="Remarks" value="{{$contact->remarks}}" />
							    	<a href="{{url('contacts', $contact->id)}}/edit" class="btn btn-primary">Edit Contact</a>
							    </div>
							</div>
	                    </div>
	                    <div class="tab-pane fade" id="profileBasic" role="tabpanel" aria-labelledby="profile-basic-tab">
							@include("invoices.table", ["invoices" => $contact->invoices])
	                    </div>
	                    <div class="tab-pane fade" id="contactBasic" role="tabpanel" aria-labelledby="contact-basic-tab">
	                    	
	                    </div>
	                </div>
					
				</div>
			</div>
		</div>
	</div>
@endsection