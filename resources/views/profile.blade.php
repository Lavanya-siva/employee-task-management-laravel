@extends('layouts.app')

@section('title','My Profile')


@section('content')


<div class="card-box">


<h3>
<i class="bi bi-person-circle me-2"></i>
My Profile
</h3>


<p class="text-muted">
Update your personal information
</p>


<hr>




@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<form method="POST" action="{{ route('profile.update') }}">

@csrf



<div class="row">



<!-- Account Information -->


<div class="col-md-6">


<h5 class="text-primary mb-3">

Account Information

</h5>



<div class="mb-3">

<label class="form-label">
First Name
</label>


<input 
type="text"
class="form-control"
value="{{ $user->firstname }}"
readonly>

</div>




<div class="mb-3">

<label class="form-label">
Middle Name
</label>


<input 
type="text"
class="form-control"
value="{{ $user->middlename }}"
readonly>

</div>





<div class="mb-3">

<label class="form-label">
Surname
</label>


<input 
type="text"
class="form-control"
value="{{ $user->surname }}"
readonly>

</div>





<div class="mb-3">

<label class="form-label">
Email
</label>


<input 
type="email"
class="form-control"
value="{{ $user->email }}"
readonly>

</div>



</div>







<!-- Personal Information -->


<div class="col-md-6">


<h5 class="text-primary mb-3">

Personal Information

</h5>




<div class="mb-3">

<label class="form-label">
Date of Birth
</label>


<input 
type="date"
name="dob"
class="form-control"

value="{{ $personalInfo->dob ?? '' }}">


</div>





<div class="mb-3">

<label class="form-label">
Phone Number
</label>


<input 
type="text"
name="phone"
class="form-control"

value="{{ $personalInfo->phone ?? '' }}">


</div>





<div class="mb-3">

<label class="form-label">
Gender
</label>


<select 
name="gender"
class="form-select">


<option value="">
Select Gender
</option>


<option value="Male"
{{ ($personalInfo->gender ?? '') == 'Male' ? 'selected':'' }}>
Male
</option>



<option value="Female"
{{ ($personalInfo->gender ?? '') == 'Female' ? 'selected':'' }}>
Female
</option>



<option value="Other"
{{ ($personalInfo->gender ?? '') == 'Other' ? 'selected':'' }}>
Other
</option>



</select>


</div>



</div>


</div>





<div class="row mt-3">


<div class="col-md-12">


<label class="form-label">

Address

</label>



<textarea
name="address"
class="form-control"
rows="4"
placeholder="Enter your address">{{ $personalInfo->address ?? '' }}</textarea>



</div>


</div>






<br>



<button type="submit"
class="btn btn-primary">


<i class="bi bi-save me-2"></i>

Update Profile


</button>



</form>



</div>


@endsection