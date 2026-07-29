@extends('layouts.app')

@section('title','My Attendance')

@section('content')

<div class="container-fluid">


<div class="card shadow">

<div class="card-header bg-primary text-white d-flex justify-content-between">

<h4>
My Attendance
</h4>


<div>

<form action="{{ route('attendance.checkin') }}" method="POST" class="d-inline">
@csrf

<button class="btn btn-light btn-sm">
Check In
</button>

</form>


<form action="{{ route('attendance.checkout') }}" method="POST" class="d-inline">
@csrf

<button class="btn btn-warning btn-sm">
Check Out
</button>

</form>

</div>


</div>



<div class="card-body">


{{-- Today's Attendance --}}

@if(isset($todayAttendance))

<div class="alert alert-info">

<strong>Today:</strong>

<br>

Check In:
{{ $todayAttendance->check_in ?? '-' }}

<br>

Check Out:
{{ $todayAttendance->check_out ?? '-' }}

<br>

Status:
{{ $todayAttendance->status ?? 'Not Marked' }}

</div>

@endif



<table class="table table-bordered">


<thead class="table-dark">

<tr>

<th>Date</th>

<th>Check In</th>

<th>Check Out</th>

<th>Status</th>

</tr>

</thead>



<tbody>


@forelse($attendance as $row)


<tr>


<td>
{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}
</td>



<td>
{{ $row->check_in ?? '-' }}
</td>



<td>
{{ $row->check_out ?? '-' }}
</td>



<td>


@if($row->status == 'Present')

<span class="badge bg-success">
Present
</span>


@elseif($row->status == 'Leave')

<span class="badge bg-warning">
Leave
</span>


@elseif($row->status == 'Absent')

<span class="badge bg-danger">
Absent
</span>


@else

<span class="badge bg-secondary">
{{ $row->status }}
</span>


@endif


</td>


</tr>



@empty


<tr>

<td colspan="4" class="text-center">

No Attendance Found

</td>

</tr>


@endforelse



</tbody>


</table>


</div>


</div>


</div>


@endsection