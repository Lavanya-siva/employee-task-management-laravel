<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Leave Request Update</title>

</head>


<body style="
    margin:0;
    padding:0;
    background:#f5f7fb;
    font-family:Arial, sans-serif;
">


<table width="100%" cellpadding="0" cellspacing="0">

<tr>

<td align="center" style="padding:40px 20px;">



<table width="600"
cellpadding="0"
cellspacing="0"
style="
background:white;
border-radius:18px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
">



<!-- HEADER -->

<tr>

<td style="
background:linear-gradient(135deg,#2563eb,#4f46e5);
padding:35px;
text-align:center;
color:white;
">


<h1 style="
margin:0;
font-size:28px;
">

📩 Leave Request Update

</h1>


<p style="
margin-top:10px;
font-size:15px;
">

Employee Management System

</p>


</td>

</tr>





<!-- BODY -->

<tr>

<td style="
padding:35px;
color:#374151;
">


<h2 style="
color:#111827;
">

Hello {{ $leave->user->firstname }} 👋

</h2>



<p style="
font-size:16px;
line-height:1.6;
">

Your leave request has been reviewed by the administrator.

</p>





<!-- STATUS -->

<div style="
text-align:center;
margin:25px 0;
">


@if($leave->status == 'Approved')


<span style="
background:#dcfce7;
color:#15803d;
padding:12px 25px;
border-radius:25px;
font-weight:bold;
font-size:16px;
">

✅ Approved

</span>


@else


<span style="
background:#fee2e2;
color:#dc2626;
padding:12px 25px;
border-radius:25px;
font-weight:bold;
font-size:16px;
">

❌ Rejected

</span>


@endif


</div>






<!-- DETAILS CARD -->


<table width="100%"
style="
background:#f9fafb;
border-radius:12px;
padding:20px;
">


<tr>

<td style="padding:10px;">

<strong>📅 From Date</strong>

</td>


<td style="padding:10px;text-align:right;">

{{ $leave->from_date->format('d-m-Y') }}

</td>

</tr>




<tr>

<td style="padding:10px;">

<strong>📅 To Date</strong>

</td>


<td style="padding:10px;text-align:right;">

{{ $leave->to_date->format('d-m-Y') }}

</td>


</tr>





<tr>

<td style="padding:10px;">

<strong>📝 Reason</strong>

</td>


<td style="
padding:10px;
text-align:right;
">

{{ $leave->reason }}

</td>


</tr>



</table>







<p style="
margin-top:30px;
font-size:15px;
line-height:1.6;
">


@if($leave->status == 'Approved')

Your leave has been approved.  
Please ensure your tasks are properly managed before your leave period.

@else

Your leave request has been rejected.  
Please contact your manager/admin for further clarification.

@endif


</p>




<p style="
margin-top:30px;
">

Regards,<br>

<strong>
Employee Management Team
</strong>

</p>



</td>

</tr>






<!-- FOOTER -->

<tr>

<td style="
background:#f3f4f6;
padding:20px;
text-align:center;
color:#6b7280;
font-size:13px;
">


© {{ date('Y') }} Employee Management System


</td>

</tr>



</table>



</td>

</tr>


</table>


</body>

</html>