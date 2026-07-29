<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manager </title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<style>

body{
    background:#f5f7fb;
}


.sidebar{

    width:260px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#1f2937;
    color:white;
    padding:25px;

}


.sidebar h3{
    font-weight:bold;
    margin-bottom:40px;
}



.sidebar a{

    display:block;
    color:#cbd5e1;
    text-decoration:none;
    padding:13px 15px;
    border-radius:10px;
    margin-bottom:8px;

}


.sidebar a:hover,
.sidebar a.active{

    background:#2563eb;
    color:white;

}



.sidebar button:hover{

    background:#2563eb !important;
    color:white !important;

}



.content{

    margin-left:260px;
    padding:35px;

}



.card-box{

    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}



.avatar{

    width:40px;
    height:40px;
    background:#2563eb;
    color:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;

}



.badge{

    padding:8px 12px;
    border-radius:20px;

}


</style>

</head>


<body>



<!-- SIDEBAR -->

<div class="sidebar">


<h3>
EMS
</h3>


<a href="/dashboard">

<i class="bi bi-speedometer2 me-2"></i>
Dashboard

</a>


<a href="/employees">

<i class="bi bi-people me-2"></i>
Organization 

</a>


<a href="/manager-assignment" class="active">

<i class="bi bi-person-workspace me-2"></i>
Manager 

</a>



<a href="/tasks">

<i class="bi bi-list-task me-2"></i>
Tasks

</a>



 <a href="{{ route('attendance.index') }}" class="nav-link">
        <i class="bi bi-calendar-check"></i>
        My Attendance
    </a>



    <a href="{{ route('leave-requests.index') }}" class="nav-link">
        <i class="bi bi-envelope-paper"></i>
        Leave Requests
    </a>




<a href="/profile">

<i class="bi bi-person-circle me-2"></i>
Profile

</a>




<form method="POST" action="/logout">

@csrf

<button type="submit"
style="
background:none;
border:none;
color:#cbd5e1;
padding:13px 15px;
width:100%;
text-align:left;
border-radius:10px;
cursor:pointer;
">

<i class="bi bi-box-arrow-right me-2"></i>

Logout

</button>


</form>


</div>





<!-- CONTENT -->


<div class="content">


<div class="card-box">



<h3>
Employee Manager Mapping
</h3>


<p class="text-muted">
View employees and assigned managers
</p>


<hr>




@if(session('success'))

<div class="alert alert-success">
{{session('success')}}
</div>

@endif



@if(session('error'))

<div class="alert alert-danger">
{{session('error')}}
</div>

@endif






<table class="table table-hover align-middle">


<thead class="table-dark">

<tr>

<th>
Employee
</th>


<th>
Email
</th>


<th>
Current Manager
</th>


@if(session('user_role') === 'admin')

<th>
Assign Manager
</th>

@endif


</tr>

</thead>




<tbody>


@forelse($employees as $employee)



<tr>


<td>


<div class="d-flex align-items-center gap-2">


<div class="avatar">

{{ strtoupper(substr($employee->firstname,0,1)) }}

</div>


<strong>

{{ $employee->firstname }}

{{ $employee->surname }}

</strong>


</div>


</td>




<td>

{{$employee->email}}

</td>




<td>


@if($employee->manager)


<span class="badge bg-success">

{{$employee->manager->firstname}}

{{$employee->manager->surname}}

</span>


@else


<span class="badge bg-secondary">

Not Assigned

</span>


@endif


</td>






@if(session('user_role') === 'admin')


<td>


<form method="POST" action="/manager-assignment">

@csrf


<input type="hidden"
name="user_id"
value="{{$employee->id}}">



<select 
name="manager_id"
class="form-select mb-2"
required>


<option value="">

Select Manager

</option>



@foreach($managers as $manager)


<option value="{{$manager->id}}"

@if($employee->manager_id == $manager->id)

selected

@endif

>

{{$manager->firstname}}

{{$manager->surname}}

</option>


@endforeach



</select>



<button class="btn btn-primary btn-sm">

<i class="bi bi-person-check me-1"></i>

Assign

</button>



</form>


</td>


@endif





</tr>




@empty


<tr>

<td colspan="4" class="text-center">

No employees found

</td>

</tr>


@endforelse



</tbody>


</table>



@if(session('user_role') === 'admin')


<div class="alert alert-info">

<i class="bi bi-info-circle me-2"></i>

Only administrators can assign managers.

</div>


@endif




</div>


</div>



</body>

</html>