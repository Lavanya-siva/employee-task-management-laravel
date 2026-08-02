<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Task Management</title>
<link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



<style>

body{
    background:#f5f7fb;
}



/* Sidebar */

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




/* Content */


.content{
    margin-left:250px;
    padding:40px ;
    margin-top:40px;
}




.card-box{

    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}





.priority{

    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;

}


.priority.low{

    background:#dcfce7;
    color:#15803d;

}



.priority.medium{

    background:#fef3c7;
    color:#b45309;

}



.priority.high{

    background:#fee2e2;
    color:#dc2626;

}





.status{

    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;

}


.status.pending{

    background:#e5e7eb;
    color:#374151;

}


.status.in_progress{

    background:#dbeafe;
    color:#2563eb;

}


.status.completed{

    background:#dcfce7;
    color:#15803d;

}

/* Due date validation message */
.due-date-warning{
    display:none;
    color:#dc2626;
    font-weight:600;
    font-size:13px;
    margin-top:6px;
}

.due-date-warning.show{
    display:block;
}

.is-invalid-date{
    border-color:#dc2626 !important;
}

/* Task table layout: fixed column widths so a long title/description
   can't stretch the row and push everything else off screen */
.task-table{
    table-layout:fixed;
    width:100%;
}

.task-table .col-title{
    width:26%;
}

.task-table .col-assigned{
    width:14%;
}

.task-table .col-creator{
    width:12%;
}

.task-table .col-priority{
    width:10%;
}

.task-table .col-due{
    width:10%;
}

.task-table .col-status{
    width:12%;
}

.task-table .col-update{
    width:16%;
}

.task-title-cell{
    display:flex;
    flex-direction:column;
    gap:4px;
    overflow:hidden;
}

.task-title-cell strong{
    word-break:break-word;
    white-space:normal;
}

.task-desc{
    word-break:break-word;
    white-space:normal;
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


    <a href="{{ route('leave-requests.index') }}" class="nav-link">
        <i class="bi bi-envelope-paper"></i>
        Leave Requests
    </a>


<a href="/profile">

<i class="bi bi-person-circle me-2"></i>

Profile

</a>





<form method="POST" action="/logout" style="display:inline;">
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








<!-- MAIN CONTENT -->


<div class="content">



<div class="card-box">



<h3>
Task Management
</h3>


<p class="text-muted">
Create and assign tasks to employees
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







<!-- CREATE TASK -->


<h5 class="mb-3">

Create New Task

</h5>




<form method="POST" action="/tasks" id="createTaskForm">


@csrf



<div class="row g-3">



<div class="col-md-6">


<label class="form-label">

Task Title

</label>


<input

type="text"

name="title"

class="form-control"

required

>


</div>





<div class="col-md-6">


<label class="form-label">

Assign Employee

</label>


<select

name="assigned_to"

class="form-select"

required>


<option value="">

Select Employee

</option>



@foreach($employees as $employee)


<option value="{{$employee->id}}">


{{$employee->firstname}}
@if($employee->middlename){{$employee->middlename}} @endif
{{$employee->surname}}


</option>



@endforeach



</select>


</div>







<div class="col-md-4">


<label class="form-label">

Priority

</label>


<select

name="priority"

class="form-select">


<option value="low">

Low

</option>


<option value="medium">

Medium

</option>


<option value="high">

High

</option>


</select>


</div>







<div class="col-md-4">


<label class="form-label">

Due Date

</label>


<input

type="date"

name="due_date"

id="due_date"

class="form-control"

required

>


<small class="due-date-warning" id="dueDateWarning">

<i class="bi bi-exclamation-circle me-1"></i>

Please enter a future date.

</small>


</div>







<div class="col-md-12">


<label class="form-label">

Description

</label>


<textarea

name="description"

class="form-control"

rows="3">

</textarea>


</div>






<div class="col-md-12">


<button type="submit" class="btn btn-primary" id="createTaskBtn">

<i class="bi bi-plus-circle me-1"></i>

Add Task

</button>


</div>



</div>



</form>






<hr class="my-5">






<!-- TASK LIST -->


<h5>

All Tasks

</h5>





<table class="table table-hover align-middle mt-3 task-table">


<thead class="table-dark">


<tr>


<th class="col-title">
Title
</th>


<th class="col-assigned">
Assigned to
</th>

<th class="col-creator">
Created By
</th>

<th class="col-priority">
Priority
</th>


<th class="col-due">
Due Date
</th>


<th class="col-status">
Status
</th>


<th class="col-update">
Update
</th>


</tr>


</thead>






<tbody>



@forelse($tasks as $task)



<tr>



<td class="col-title">

<div class="task-title-cell">

<strong title="{{$task->title}}">

{{$task->title}}

</strong>


<small class="text-muted task-desc" title="{{$task->description}}">

{{$task->description}}

</small>

</div>

</td>





<td class="col-assigned">


@if($task->employee)


{{$task->employee->firstname}}
@if($task->employee->middlename){{$task->employee->middlename}} @endif
{{$task->employee->surname}}


@else

Not Assigned

@endif


</td>

<td class="col-creator">

@if($task->creator)

{{$task->creator->firstname}}
@if($task->creator->middlename){{$task->creator->middlename}} @endif
{{$task->creator->surname}}

@else

Unknown

@endif

</td>



<td class="col-priority">


<span class="priority {{$task->priority}}">


{{ucfirst($task->priority)}}


</span>


</td>







<td class="col-due">


{{$task->due_date}}


</td>








<td class="col-status">


<span class="status {{$task->status}}">


{{str_replace('_',' ',ucfirst($task->status))}}


</span>


</td>






<td class="col-update">



<form method="POST" action="/tasks/{{$task->id}}/status">


@csrf



<select

name="status"

class="form-select form-select-sm mb-2">


<option value="pending"
{{$task->status=='pending'?'selected':''}}>
Pending
</option>


<option value="in_progress"
{{$task->status=='in_progress'?'selected':''}}>
In Progress
</option>


<option value="completed"
{{$task->status=='completed'?'selected':''}}>
Completed
</option>


</select>





<button class="btn btn-success btn-sm">

Update

</button>



</form>



</td>





</tr>



@empty


<tr>

<td colspan="7" class="text-center">

No tasks found

</td>

</tr>



@endforelse



</tbody>



</table>





</div>



</div>



<script>
(function () {
    const dueDateInput = document.getElementById('due_date');
    const warningEl = document.getElementById('dueDateWarning');
    const form = document.getElementById('createTaskForm');

    // Set the earliest selectable date to today (calendar-level restriction)
    function getTodayString() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    const todayStr = getTodayString();
    dueDateInput.setAttribute('min', todayStr);

    function isPastOrToday(value) {
        if (!value) return false;
        return value <= todayStr;
    }

    function validateDueDate() {
        if (isPastOrToday(dueDateInput.value)) {
            warningEl.classList.add('show');
            dueDateInput.classList.add('is-invalid-date');
            return false;
        } else {
            warningEl.classList.remove('show');
            dueDateInput.classList.remove('is-invalid-date');
            return true;
        }
    }

    // Live validation as the user picks/types a date
    dueDateInput.addEventListener('input', validateDueDate);
    dueDateInput.addEventListener('change', validateDueDate);

    // Block submission if the date is invalid
    form.addEventListener('submit', function (e) {
        if (!validateDueDate()) {
            e.preventDefault();
            dueDateInput.focus();
        }
    });
})();
</script>


</body>

</html>