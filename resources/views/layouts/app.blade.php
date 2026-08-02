<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
@yield('title','Employee Management System')
</title>
<link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<style>

body{
    background:#f5f7fb;
    overflow-x:hidden;
}


.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:#1f2937;
    color:white;
    left:0;
    top:0;
    padding:25px;
}


.sidebar h3{
    font-weight:bold;
    margin-bottom:40px;
}


.sidebar a{
    color:#cbd5e1;
    text-decoration:none;
    display:block;
    padding:13px 15px;
    border-radius:10px;
    margin-bottom:8px;
}


.sidebar a:hover,
.sidebar a.active{
    background:#2563eb;
    color:white;
}


.content{
    margin-left:260px;
    padding:35px;
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




<a href="/manager-assignment">

<i class="bi bi-person-workspace me-2"></i>

Manager 

</a>




<a href="/tasks">

<i class="bi bi-list-task me-2"></i>

Tasks

</a>




@if(session('user_role') !== 'admin')
<a href="{{route('attendance.index')}}">

<i class="bi bi-calendar-check me-2"></i>

My Attendance

</a>
@endif




<a href="{{ route('leave-requests.index') }}">

<i class="bi bi-envelope-paper me-2"></i>

Leave Requests

</a>




<a href="/profile">

<i class="bi bi-person-circle me-2"></i>

Profile

</a>





<form method="POST" action="/logout">

@csrf

<button class="btn text-start text-light w-100">

<i class="bi bi-box-arrow-right me-2"></i>

Logout

</button>

</form>



</div>





<!-- PAGE CONTENT -->


<div class="content">


@yield('content')


</div>




</body>

</html>