<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Happy Birthday</title>
</head>


<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td align="center">


<table width="600" cellpadding="0" cellspacing="0" 
style="background:#ffffff;border-radius:8px;overflow:hidden;">


<!-- Header -->

<tr>
<td style="background:#2563eb;color:white;padding:20px;text-align:center;">

<h1 style="margin:0;">
🎂 Happy Birthday 🎉
</h1>

</td>
</tr>



<!-- Body -->

<tr>
<td style="padding:30px;color:#333;">


<p>
Dear 
<strong>{{ $receiver->firstname }} {{ $receiver->surname }}</strong>,
</p>



<p>
Wishing you a very 
<strong>Happy Birthday</strong> 🎂🥳
</p>



<p>
Hope your special day is filled with happiness,
success, and lots of beautiful moments.
</p>



<p>
May this new year of your life bring you
good health, growth, and endless opportunities ✨
</p>



<p style="margin-top:30px;">

Warm wishes,<br>

<strong>
{{ $sender->firstname }} {{ $sender->surname }}
</strong>

</p>



</td>
</tr>




<!-- Footer -->

<tr>

<td style="background:#f1f5f9;text-align:center;padding:15px;font-size:12px;color:#666;">

© {{ date('Y') }} EMS. All rights reserved.

</td>

</tr>


</table>


</td>
</tr>

</table>


</body>

</html>