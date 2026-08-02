@extends('layouts.app')


@section('title','Leave Requests')


@section('content')


<div class="container-fluid">


@if(session('user_role') != 'admin')

<!-- APPLY LEAVE REQUEST -->

<div class="card shadow mb-4">


    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            Request Leave
        </h4>

    </div>


    <div class="card-body">


        <form method="POST" action="{{ route('leave-requests.store') }}">

            @csrf


            <div class="row">


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        From Date
                    </label>


                    <input 
                        type="date"
                        name="from_date"
                        class="form-control"
                        required>

                </div>



                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        To Date
                    </label>


                    <input 
                        type="date"
                        name="to_date"
                        class="form-control"
                        required>

                </div>


            </div>



            <div class="mb-3">

                <label class="form-label">
                    Reason
                </label>


                <textarea
                    name="reason"
                    class="form-control"
                    rows="3"
                    required></textarea>


            </div>



            <button class="btn btn-primary">

                <i class="bi bi-send me-2"></i>

                Submit Request

            </button>


        </form>


    </div>


</div>

@endif





<!-- LEAVE REQUEST LIST -->


<div class="card shadow">


<div class="card-header bg-dark text-white">


<h4 class="mb-0">


@if(session('user_role') == 'admin')

All Employee Leave Requests

@else

My Leave Requests

@endif


</h4>


</div>




<div class="card-body">


<table class="table table-bordered table-striped">


<thead>


<tr>

@if(session('user_role') == 'admin')

<th>
Employee
</th>

@endif


<th>
From
</th>


<th>
To
</th>


<th>
Reason
</th>


<th>
Status
</th>



@if(session('user_role') == 'admin')

<th>
Action
</th>

@endif


</tr>


</thead>




<tbody>



@forelse($requests as $leave)


<tr>



@if(session('user_role') == 'admin')

<td>

{{ $leave->user->firstname }}
@if($leave->user->middlename){{$leave->user->middlename}} @endif
{{ $leave->user->surname }}

</td>

@endif




<td>

{{ $leave->from_date->format('d-m-Y') }}

</td>



<td>

{{ $leave->to_date->format('d-m-Y') }}

</td>



<td>

{{ $leave->reason }}

</td>




<td>


@if($leave->status == 'Approved')


<span class="badge bg-success">

Approved

</span>


@elseif($leave->status == 'Rejected')


<span class="badge bg-danger">

Rejected

</span>


@else


<span class="badge bg-warning text-dark">

Pending

</span>


@endif


</td>





@if(session('user_role') == 'admin')


<td>


@if($leave->status == 'Pending')


<form method="POST"
action="{{route('leave-requests.approve',$leave->id)}}"
class="d-inline">


@csrf


<button class="btn btn-success btn-sm">

<i class="bi bi-check-circle"></i>

Approve

</button>


</form>




<form method="POST"
action="{{route('leave-requests.reject',$leave->id)}}"
class="d-inline">


@csrf


<button class="btn btn-danger btn-sm">

<i class="bi bi-x-circle"></i>

Reject

</button>


</form>



@else


<span class="text-muted">

Completed

</span>


@endif



</td>


@endif




</tr>



@empty



<tr>

<td colspan="6" class="text-center">

No Leave Requests Found

</td>

</tr>



@endforelse



</tbody>


</table>


</div>


</div>


</div>


@endsection