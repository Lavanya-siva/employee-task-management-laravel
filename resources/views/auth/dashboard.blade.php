<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Employee Management System</title>
<link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



<style>

body{
    background:#f5f7fb;
    overflow-x:hidden;
}


/* Sidebar */

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




/* Main */

.content{

    margin-left:260px;
    padding:35px;

}




.welcome-card{

    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );

    color:white;
    border-radius:20px;
    padding:35px;
    margin-bottom:30px;

}




.stat-card{

    border:none;
    border-radius:18px;
    box-shadow:
    0 10px 25px rgba(0,0,0,.08);

    transition:.3s;

}



.stat-card:hover{

    transform:translateY(-5px);

}




.icon-box{

    width:60px;
    height:60px;
    border-radius:15px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:26px;
    color:white;

}



.purple{
    background:#6366f1;
}


.green{
    background:#10b981;
}


.orange{
    background:#f59e0b;
}





.activity,
.user-box{

    background:white;
    border-radius:18px;
    padding:25px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.08);

}



.progress{

    height:10px;
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



<a href="/dashboard" class="active">

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




<a href="{{route('leave-requests.index')}}">

<i class="bi bi-envelope-paper me-2"></i>

Leave Requests

</a>





<a href="/profile">

<i class="bi bi-person-circle me-2"></i>

Profile

</a>




<form method="POST" action="/logout">

@csrf


<button
style="
background:none;
border:none;
color:#cbd5e1;
padding:13px 15px;
width:100%;
text-align:left;
">


<i class="bi bi-box-arrow-right me-2"></i>

Logout


</button>


</form>



</div>





<!-- CONTENT -->

<div class="content">



<div class="welcome-card">


<h2 id="greeting">
    Welcome {{ session('user_name') }} 👋
</h2>


<p class="mb-0">

Employee Management Dashboard

</p>


</div>






<!-- STATISTICS -->


<div class="row g-4">



<div class="col-lg-4">


<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">
Employees
</small>


<h2>
{{ $employeeCount }}
</h2>


</div>


<div class="icon-box purple">

<i class="bi bi-people-fill"></i>

</div>


</div>


</div>


</div>





<div class="col-lg-4">


<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">
Managers
</small>


<h2>
{{ $managerCount }}
</h2>


</div>


<div class="icon-box green">

<i class="bi bi-person-badge-fill"></i>

</div>


</div>


</div>


</div>





<div class="col-lg-4">


<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<small class="text-muted">
Pending Tasks
</small>


<h2>
{{ $pendingTasks }}
</h2>


</div>



<div class="icon-box orange">

<i class="bi bi-list-check"></i>

</div>


</div>


</div>


</div>



</div>
<!-- LOWER CONTENT -->

<div class="row mt-4">



<!-- PROJECT PROGRESS -->

<div class="col-lg-8">


<div class="activity">


<h5 class="mb-4">

Overall Project Progress

</h5>




<p>
Employee Records
</p>


<div class="progress mb-3">

<div class="progress-bar bg-primary"
style="width:85%">
</div>

</div>





<p>
Task Completion
</p>


<div class="progress mb-3">

<div class="progress-bar bg-success"
style="width:70%">
</div>

</div>





<p>
Attendance Tracking
</p>


<div class="progress">


<div class="progress-bar bg-warning"
style="width:90%">
</div>


</div>




</div>


</div>







<!-- BIRTHDAY SECTION -->


<div class="col-lg-4">


<div class="user-box">



<h5 class="mb-4">

🎂 Today's Birthday Babies

</h5>




@if($birthdayBabies->count())


@foreach($birthdayBabies as $employee)



<div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">


<div>


<h6 class="mb-1">

{{ $employee->firstname }}
@if($employee->middlename) {{ $employee->middlename }} @endif
{{ $employee->surname }}

</h6>

<small class="text-muted">
    @if($employee->role == 'user')
        Member
    @else
        {{ ucfirst($employee->role) }}
    @endif
</small>


</div>





<form method="POST"
action="{{route('employee.wish',$employee->id)}}">


@csrf


<button class="btn btn-primary btn-sm">


<i class="bi bi-gift-fill"></i>

Wish


</button>


</form>



</div>



@endforeach



@else


<p class="text-muted">

No birthdays today 🎂

</p>


@endif




</div>


</div>




</div>





</div>






<!-- SUCCESS TOAST -->

@if(session('success'))


<div class="position-fixed top-0 end-0 p-4"
style="z-index:9999;">



<div id="wishToast"
class="toast show shadow border-0"
role="alert"
style="
min-width:350px;
border-radius:20px;
overflow:hidden;
background:white;
">



<div class="d-flex align-items-center">



<div class="bg-success text-white p-3">

<i class="bi bi-stars fs-2"></i>

</div>





<div class="toast-body">


<h6 class="text-success mb-1">

🎉 Wish Sent Successfully!

</h6>



<span>

{{session('success')}}

</span>


</div>





<button 
type="button"
class="btn-close me-3"
data-bs-dismiss="toast">

</button>




</div>



</div>


</div>



@endif








<!-- GREETING SCRIPT -->


<script>


function updateGreeting(){


let hour = new Date().getHours();


let greeting;



if(hour >=5 && hour <12){

greeting="Good Morning  {{ session('user_name') }}!";

}

else if(hour >=12 && hour <17){

greeting="Good Afternoon  {{ session('user_name') }}!";

}

else if(hour >=17 && hour <21){

greeting="Good Evening  {{ session('user_name') }}!";

}

else{

greeting="Night Owl {{ session('user_name') }}!";

}




document.getElementById("greeting").innerHTML =
greeting;


}



updateGreeting();



</script>







<!-- AUTO CLOSE TOAST -->


@if(session('success'))


<script>


setTimeout(()=>{


let toast=document.getElementById("wishToast");


if(toast){

toast.remove();

}


},4000);



</script>


@endif







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>


</html>