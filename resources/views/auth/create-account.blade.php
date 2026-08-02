<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Account</title>
<link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}


body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:20px;

    background:
    linear-gradient(135deg,#667eea,#764ba2);

    overflow-x:hidden;

}



/* Animated background circles */

body::before,
body::after{

    content:"";

    position:absolute;

    border-radius:50%;

    background:rgba(255,255,255,.15);

    animation:float 6s infinite alternate;

}


body::before{

    width:350px;

    height:350px;

    top:-120px;

    left:-120px;

}



body::after{

    width:250px;

    height:250px;

    bottom:-80px;

    right:-80px;

}



.container{

    width:100%;

    max-width:520px;

    position:relative;

    z-index:1;

    animation:slide .8s ease;

}



.card{


    background:rgba(255,255,255,.95);


    padding:35px;


    border-radius:25px;


    box-shadow:

    0 20px 40px rgba(0,0,0,.25);


}




.title{

    text-align:center;

    margin-bottom:30px;

}



.title h2{

    font-size:32px;

    color:#333;

}


.title p{

    color:#777;

    margin-top:8px;

}



.banner{

    padding:12px 15px;

    border-radius:10px;

    margin-bottom:20px;

    font-size:14px;

}


.banner.error-banner{

    background:#fdecea;

    color:#e63946;

    border:1px solid #f5c2c7;

}


.banner.success-banner{

    background:#e6f7ee;

    color:#1a7f4e;

    border:1px solid #b9e6cd;

}




.form-group{

    position:relative;

    margin-top:8px;

    margin-bottom:25px;

}





.form-group input,
.form-group select{


    width:100%;


    padding:14px 15px;


    border:none;


    outline:none;


    border-radius:12px;


    background:#f1f3f6;


    font-size:15px;


    transition:.3s;

}



.form-group input:focus,
.form-group select:focus{


    background:white;


    box-shadow:

    0 0 0 2px #667eea;


}




.form-group label{


    position:absolute;


    left:15px;


    top:14px;


    color:#777;


    pointer-events:none;


    transition:.2s ease all;


    background:transparent;


    padding:0 4px;

}



/* Hide the native placeholder text/glyph but keep the element functional
   so we can key off :placeholder-shown for text inputs */

.form-group input::placeholder{

    opacity:0;

}



/* Float the label up and shrink it when focused, OR when the field
   actually has content (::placeholder-shown covers "empty vs not")  */

.form-group input:focus + label,
.form-group input:not(:placeholder-shown) + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

    padding:0 4px;

}



/* Selects don't support :placeholder-shown, so float the label on
   focus or once a real (non-empty) option is chosen via :valid.
   The blank "Select Role" option below is marked disabled so the
   select is :invalid until a real option is picked. */

.form-group select:focus + label,
.form-group select:valid + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

    padding:0 4px;

}



/* Autofilled fields (Chrome) don't always trigger the above the same
   way, so cover them too */

.form-group input:-webkit-autofill + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

}




/* Role select: strip native appearance, add a custom chevron, and match
   the input styling exactly (same padding, radius, focus ring, etc.) */

.form-group select#role{

    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;

    color:#333;

    padding-right:40px;

    cursor:pointer;

    background-image:
        url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='8' viewBox='0 0 14 8'><path d='M1 1l6 6 6-6' fill='none' stroke='%23667eea' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>");

    background-repeat:no-repeat;

    background-position:right 16px center;

    background-size:14px 8px;

}


.form-group select#role option{

    color:#333;

}


.form-group select#role option[value=""]{

    color:#999;

}


.form-group select#role:focus{

    background-color:#fff;

    background-image:
        url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='8' viewBox='0 0 14 8'><path d='M1 1l6 6 6-6' fill='none' stroke='%23667eea' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>");

    background-repeat:no-repeat;

    background-position:right 16px center;

    background-size:14px 8px;

}




.error{


    display:block;

    margin-top:5px;

    color:#e63946;

    font-size:13px;

}




.checkbox{


    display:flex;

    align-items:center;

    gap:10px;

    margin-bottom:25px;

    font-size:14px;

    color:#555;

}



.checkbox input{

    width:16px;

    height:16px;

}



.checkbox a{

    color:#667eea;

    text-decoration:none;

}



button{


    width:100%;


    padding:14px;


    border:none;


    border-radius:30px;


    background:

    linear-gradient(135deg,#667eea,#764ba2);


    color:white;


    font-size:17px;


    cursor:pointer;


    transition:.3s;


}




button:hover{


    transform:translateY(-3px);


    box-shadow:

    0 10px 25px rgba(102,126,234,.5);


}



.back-to-login{

    text-align:center;

    margin-top:22px;

    font-size:14px;

    color:#555;

}


.back-to-login a{

    color:#667eea;

    text-decoration:none;

    font-weight:600;

}


.back-to-login a:hover{

    text-decoration:underline;

}


@keyframes slide{


from{

    opacity:0;

    transform:translateY(-50px);

}


to{

    opacity:1;

    transform:translateY(0);

}

}



@keyframes float{


from{

    transform:translateY(0);

}


to{

    transform:translateY(50px);

}

}




@media(max-width:600px){


.card{

    padding:25px;

}


.title h2{

    font-size:26px;

}


}


</style>


</head>



<body>


<div class="container">


<div class="card">


<div class="title">

<h2>Create Account</h2>

<p>Create your account and get started</p>

</div>



{{-- General (non-field-specific) failure/success banners --}}

@if(session('failure'))
<div class="banner error-banner">
{{ session('failure') }}
</div>
@endif

@if(session('success'))
<div class="banner success-banner">
{{ session('success') }}
</div>
@endif




<form method="POST" action="/api/create-account">

@csrf



<div class="form-group">

<input
type="text"
id="firstname"
name="firstname"
placeholder=" "
value="{{ old('firstname') }}"
required>

<label for="firstname">First Name</label>

@error('firstname')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="text"
id="middlename"
name="middlename"
placeholder=" "
value="{{ old('middlename') }}">

<label for="middlename">Middle Name</label>

@error('middlename')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="text"
id="surname"
name="surname"
placeholder=" "
value="{{ old('surname') }}"
required>

<label for="surname">Surname</label>

@error('surname')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="email"
id="email"
name="email"
placeholder=" "
value="{{ old('email') }}"
required>

<label for="email">Email</label>

@error('email')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="text"
id="phone_no"
name="phone_no"
placeholder=" "
value="{{ old('phone_no') }}"
required>

<label for="phone_no">Phone Number</label>

@error('phone_no')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="password"
id="password"
name="password"
placeholder=" "
required>

<label for="password">Password</label>

@error('password')
<span class="error">{{$message}}</span>
@enderror

</div>




<div class="form-group">

<input
type="password"
id="password_confirmation"
name="password_confirmation"
placeholder=" "
required>

<label for="password_confirmation">Confirm Password</label>

<span class="error" id="password-match-error" style="display:none;">
Passwords do not match
</span>

</div>




<div class="form-group">

<select name="role" id="role" required>

<option value="" disabled selected>
Select Role
</option>


<option value="admin"
{{ old('role') == 'admin' ? 'selected' : '' }}>
Admin
</option>


<option value="manager"
{{ old('role') == 'manager' ? 'selected' : '' }}>
Manager
</option>


<option value="user"
{{ old('role') == 'user' ? 'selected' : '' }}>
Member
</option>


</select>

<label for="role"></label>


@error('role')

<span class="error">
{{ $message }}
</span>

@enderror


</div>





<div class="checkbox">


<input
type="checkbox"
name="terms_cond"
value="1"
{{old('terms_cond')?'checked':''}}
required>


<span>
I agree to Terms & Conditions
</span>


@error('terms_cond')
<span class="error">{{$message}}</span>
@enderror


</div>




<button type="submit">

Create Account

</button>



</form>



<div class="back-to-login">

Already have an account?
<a href="/login">Back to Login</a>

</div>



</div>


</div>



<script>

const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('password_confirmation');
const matchError = document.getElementById('password-match-error');
const form = document.querySelector('form');

function checkPasswordsMatch(){

    if(confirmInput.value && passwordInput.value !== confirmInput.value){

        matchError.style.display = 'block';
        confirmInput.style.boxShadow = '0 0 0 2px #e63946';

        return false;

    } else {

        matchError.style.display = 'none';
        confirmInput.style.boxShadow = '';

        return true;

    }

}

passwordInput.addEventListener('input', checkPasswordsMatch);
confirmInput.addEventListener('input', checkPasswordsMatch);

form.addEventListener('submit', function(e){

    if(!checkPasswordsMatch()){

        e.preventDefault();

    }

});

</script>



</body>

</html>