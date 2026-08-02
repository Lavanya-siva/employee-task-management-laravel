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


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
<button type="button" class="btn-close" onclick="this.closest('.alert').remove()" aria-label="Close"></button>
</div>
@endif


@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('error') }}
<button type="button" class="btn-close" onclick="this.closest('.alert').remove()" aria-label="Close"></button>
</div>
@endif


{{-- Today's Attendance --}}

@if(isset($todayAttendance))

@php
$computedStatus = 'Not Marked';
$hoursWorked = null;

if($todayAttendance->check_in && $todayAttendance->check_out){
    $checkIn = \Carbon\Carbon::parse($todayAttendance->check_in);
    $checkOut = \Carbon\Carbon::parse($todayAttendance->check_out);
    $hoursWorked = $checkIn->diffInMinutes($checkOut) / 60;

    $computedStatus = $hoursWorked >= 8 ? 'Present' : 'Absent';
}
@endphp

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
{{ $computedStatus }}

</div>


@if($todayAttendance->check_out && $hoursWorked !== null)

    @if($hoursWorked >= 8)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    You worked {{ round($hoursWorked,2) }} hours today — marked as <strong>Present</strong>.
    <button type="button" class="btn-close" onclick="this.closest('.alert').remove()"></button>
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    You only worked {{ round($hoursWorked,2) }} hours today (under 8) — marked as <strong>Absent</strong>.
    <button type="button" class="btn-close" onclick="this.closest('.alert').remove()"></button>
    </div>
    @endif

@endif

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