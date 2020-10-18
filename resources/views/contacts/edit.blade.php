@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Contact" />
	<form action="{{url('contacts', $contact->id)}}" method="post">
		@csrf()
		@method('PATCH')
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="fname" label="First Name" :value="$contact->fname"/>
						    	<x-input name="lname" label="Last Name" :value="$contact->lname"/>
						    	<x-input name="oname" label="Other Name" :value="$contact->oname"/>
						    	<x-input name="mobile" label="Mobile" :value="$contact->mobile"/>
						    	<x-input name="email" label="Email" :value="$contact->email"/>
						    	<x-input name="street" label="Street" :value="$contact->street"/>
						    	<x-input name="city" label="City" :value="$contact->city"/>
						    </div>
						    <div class="col-md-6">
						    	<x-input name="postal" label="Postal" :value="$contact->postal"/>
						    	<x-input-dynamic name="other" label="Other Details" :value="$contact->other" />
						    	<x-select2 name="type" label="Type">
						    		<x-slot name="options">
						    			<option value="Volunteer">Volunteer</option>
						    			<option value="Paid Volunteer">Paid Volunteer</option>
						    		</x-slot>
						    	</x-select2>
						    </div>
						</div>
						<div class="row">
						    <div class="col-md-12">
						    	<x-area name="remarks" label="Remarks" :value="$contact->remarks" />
						    	<button type="submit" class="btn btn-primary">Update Contact</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection