<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Employees</title>


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


/* Main */

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


/* Avatar */

.avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#2563eb;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
}

.col-md-2{
    display: flex;
    gap:1rem;
}


/* Roles */

.role{
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}


.role.admin{
    background:#fee2e2;
    color:#dc2626;
}


.role.manager{
    background:#dcfce7;
    color:#15803d;
}


.role.user{
    background:#dbeafe;
    color:#2563eb;
}


/* Actions */

.btn-icon{
    width:34px;
    height:34px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    padding:0;
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


<a href="/employees" class="active">

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






<!-- CONTENT -->

<div class="content">


<div class="card-box">


<h3>
Organization 
</h3>


<p class="text-muted">
Manage all registered users
</p>


<hr>


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif




<!-- FILTERS -->


<div class="row g-3 mb-4">


<div class="col-md-4">

<input 
type="text"
id="search"
class="form-control"
placeholder="Search employee..."
>

</div>




<div class="col-md-3">

<select id="roleFilter" class="form-select">


<option value="">
All Roles
</option>


<option value="admin">
Admin
</option>


<option value="manager">
Manager
</option>


<option value="user">
User
</option>


</select>

</div>




<div class="col-md-3">

<select id="sortBy" class="form-select">


<option value="id">
Sort By ID
</option>


<option value="name">
Sort By Name
</option>


<option value="email">
Sort By Email
</option>


<option value="role">
Sort By Role
</option>


<option value="date">
Sort By Date
</option>


</select>


</div>




<div class="col-md-2">


<button 
id="ascSort"
class="btn btn-success w-100">

↑ Asc

</button>



<button 
id="descSort"
class="btn btn-secondary w-100">

↓ Desc

</button>


</div>


</div>







<table class="table table-hover align-middle">


<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Role</th>

<th>Joined</th>

<th class="text-center">Actions</th>

</tr>


</thead>



<tbody id="employeeTable">


@foreach($employees as $employee)


<tr

data-id="{{ $employee->id }}"

data-name="{{ strtolower($employee->firstname.' '.$employee->surname) }}"

data-email="{{ strtolower($employee->email) }}"

data-role="{{ $employee->role }}"

data-date="{{ $employee->created_at }}"

>


<td>
{{ $employee->id }}
</td>



<td>

<div class="d-flex align-items-center gap-2">


<div class="avatar">

{{ strtoupper(substr($employee->firstname,0,1)) }}

</div>


{{ $employee->firstname }}

{{ $employee->middlename }}

{{ $employee->surname }}


</div>

</td>



<td>

{{ $employee->email }}

</td>



<td>

{{ $employee->phone_no }}

</td>




<td>


@if($employee->role == 'admin')

<span class="role admin">
Admin
</span>


@elseif($employee->role == 'manager')

<span class="role manager">
Manager
</span>


@else

<span class="role user">
User
</span>


@endif


</td>



<td>

{{ $employee->created_at->format('d M Y') }}

</td>


<td class="text-center">

<div class="d-flex justify-content-center gap-2">

<form
    action="/employees/{{ $employee->id }}"
    method="POST"
    class="delete-employee-form"
    style="display:inline;"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-outline-danger btn-icon"
        title="Delete"
        data-name="{{ $employee->firstname }} {{ $employee->surname }}"
    >
        <i class="bi bi-trash"></i>
    </button>

</form>

</div>

</td>


</tr>


@endforeach


</tbody>


</table>



</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>


const search =
document.getElementById("search");


const roleFilter =
document.getElementById("roleFilter");


const sortBy =
document.getElementById("sortBy");


const table =
document.getElementById("employeeTable");



let sortDirection = "asc";




// SEARCH + ROLE FILTER

function filterEmployees(){


let searchValue =
search.value.toLowerCase();


let roleValue =
roleFilter.value;



let rows =
document.querySelectorAll("#employeeTable tr");



rows.forEach(row=>{


let name =
row.dataset.name;


let email =
row.dataset.email;


let role =
row.dataset.role;



let searchMatch =
name.includes(searchValue)
||
email.includes(searchValue);



let roleMatch =
roleValue === ""
||
role === roleValue;



if(searchMatch && roleMatch){

row.style.display="";

}
else{

row.style.display="none";

}


});


}




// SORT

function sortEmployees(){


let rows =
Array.from(
document.querySelectorAll("#employeeTable tr")
);



let field =
sortBy.value;



rows.sort((a,b)=>{


let first="";
let second="";



if(field==="id"){

first=Number(a.dataset.id);
second=Number(b.dataset.id);

return sortDirection === "asc"
?
first - second
:
second - first;

}



if(field==="name"){

first=a.dataset.name;
second=b.dataset.name;

}



if(field==="email"){

first=a.dataset.email;
second=b.dataset.email;

}



if(field==="role"){

first=a.dataset.role;
second=b.dataset.role;

}



if(field==="date"){

first=a.dataset.date;
second=b.dataset.date;

}



if(first < second){

return sortDirection === "asc"
?
-1
:
1;

}



if(first > second){

return sortDirection === "asc"
?
1
:
-1;

}



return 0;


});



rows.forEach(row=>{

table.appendChild(row);

});


}





search.addEventListener(
"keyup",
filterEmployees
);



roleFilter.addEventListener(
"change",
filterEmployees
);



sortBy.addEventListener(
"change",
sortEmployees
);



document
.getElementById("ascSort")
.addEventListener("click",()=>{


sortDirection="asc";

sortEmployees();


});




document
.getElementById("descSort")
.addEventListener("click",()=>{


sortDirection="desc";

sortEmployees();


});



// DELETE CONFIRMATION

document.querySelectorAll(".delete-employee-form").forEach(form=>{

form.addEventListener("submit", function(e){

let name = this.querySelector("button[type=submit]").dataset.name;

let confirmed = confirm("Are you sure you want to delete " + name + "? This action cannot be undone.");

if(!confirmed){
    e.preventDefault();
}

});

});



</script>



</body>

</html>