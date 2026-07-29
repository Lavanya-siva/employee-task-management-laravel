<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>


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

    overflow:hidden;

}



/* Background animation */

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





.login-container{


    width:380px;


    padding:35px;


    background:rgba(255,255,255,.95);


    border-radius:25px;


    box-shadow:

    0 20px 40px rgba(0,0,0,.25);


    animation:slide .8s ease;


    position:relative;

    z-index:1;


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


    margin-top:8px;

    color:#777;


}






.input-box{


    position:relative;

    margin-bottom:25px;


}





.input-box input{


    width:100%;


    padding:14px 15px;


    border:none;


    outline:none;


    border-radius:12px;


    background:#f1f3f6;


    font-size:15px;


    transition:.3s;


}





.input-box input:focus{


    background:white;


    box-shadow:

    0 0 0 2px #667eea;


}





.input-box label{


    position:absolute;


    left:15px;


    top:14px;


    color:#777;


    pointer-events:none;


    transition:.3s;


}




.input-box input:focus + label,
.input-box input:valid + label{


    top:-10px;


    font-size:12px;


    background:white;


    padding:0 5px;


    color:#667eea;


}





button{


    width:100%;


    padding:14px;


    border:none;


    border-radius:30px;


    cursor:pointer;


    font-size:17px;


    color:white;



    background:

    linear-gradient(135deg,#667eea,#764ba2);


    transition:.3s;


}





button:hover{


    transform:translateY(-3px);


    box-shadow:

    0 10px 25px rgba(102,126,234,.5);


}






.error{


    color:#e63946;


    font-size:13px;


    display:block;


    margin-top:5px;


}






.links{


    text-align:center;


    margin-top:20px;


}





.links a{


    color:#667eea;


    text-decoration:none;


    font-weight:600;


}





.links a:hover{


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



@media(max-width:500px){


.login-container{

    width:100%;

    padding:25px;

}


.title h2{

    font-size:26px;

}


}



</style>


</head>



<body>



<div class="login-container">



<div class="title">

<h2>Welcome Back</h2>

<p>Login to continue your journey</p>

</div>




<form method="POST" action="/login">

@csrf




<div class="input-box">


<input 
type="email"
name="email"
value="{{ old('email') }}"
required>


<label>Email</label>



@error('email')

<span class="error">

{{ $message }}

</span>

@enderror


</div>





<div class="input-box">


<input 
type="password"
name="password"
required>


<label>Password</label>



@error('password')

<span class="error">

{{ $message }}

</span>

@enderror


</div>





<button type="submit">

Login

</button>





<div class="links">

<a href="/create-account">

Create Account

</a>

</div>



</form>



</div>



</body>

</html>