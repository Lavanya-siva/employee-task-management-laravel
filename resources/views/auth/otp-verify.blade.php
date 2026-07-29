<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verify OTP</title>


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

    max-width:420px;

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

    font-size:30px;

    color:#333;

}


.title p{

    color:#777;

    margin-top:8px;

    font-size:14px;

}



.banner{

    padding:12px 15px;

    border-radius:10px;

    margin-bottom:20px;

    font-size:14px;

    display:none;

}


.banner.show{

    display:block;

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





.form-group input{


    width:100%;


    padding:14px 15px;


    border:none;


    outline:none;


    border-radius:12px;


    background:#f1f3f6;


    font-size:15px;


    transition:.3s;

}



.form-group input:focus{


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




/* Float the label up and shrink it when focused OR when the field has a valid value */

.form-group input:focus + label,
.form-group input:valid + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

    font-family: 'Segoe UI', sans-serif;

}


/* Autofilled fields (Chrome) don't always trigger :valid the same way, so cover them too */

.form-group input:-webkit-autofill + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

}



/* OTP input specific styling - spaced out digit entry */

.otp-input{

    letter-spacing:10px;

    font-size:22px !important;

    text-align:center;

    font-weight:600;

}




.error{


    display:none;

    margin-top:5px;

    color:#e63946;

    font-size:13px;

}


.error.show{

    display:block;

}




.resend{

    text-align:center;

    font-size:14px;

    color:#555;

    margin-bottom:20px;

}


.resend a{

    background:none;

    border:none;

    color:#667eea;

    font-weight:600;

    cursor:pointer;

    text-decoration:underline;

    padding:0;

    width:auto;

    font-size:14px;

}


.resend a:hover{

    transform:none;

    box-shadow:none;

}


.resend a.disabled{

    color:#aaa;

    cursor:not-allowed;

    text-decoration:none;

    pointer-events:none;

}




button.submit-btn{


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




button.submit-btn:hover{


    transform:translateY(-3px);


    box-shadow:

    0 10px 25px rgba(102,126,234,.5);


}


button.submit-btn:disabled{

    opacity:.6;

    cursor:not-allowed;

    transform:none;

    box-shadow:none;

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

    font-size:24px;

}


}


</style>


</head>



<body>


<div class="container">


<div class="card">


<div class="title">

<h2>Verify OTP</h2>

<p>Enter the 6-digit code sent to your email</p>

</div>



{{-- General banners - toggled via JS, no page reload --}}

<div id="errorBanner" class="banner error-banner"></div>
<div id="successBanner" class="banner success-banner"></div>




<form id="verifyForm">

<div class="form-group">

<input
type="email"
id="email"
name="email"
value="{{ $email ?? '' }}"
required>

<label for="email">Email</label>

<span class="error" id="email-error"></span>

</div>




<div class="form-group">

<input
type="text"
id="otp_code"
name="otp_code"
class="otp-input"
maxlength="6"
inputmode="numeric"
pattern="\d{6}"
autocomplete="one-time-code"
required>

<label for="otp_code">6-Digit Code</label>

<span class="error" id="otp_code-error"></span>

</div>




<div class="resend">

Didn't get the code?

<a href="/api/resend-otp" id="resendBtn">Resend OTP</a>

</div>




<button type="submit" class="submit-btn" id="verifyBtn">

Verify Account

</button>



</form>


</div>


</div>


<script>

const API_BASE = '/api';

const verifyForm = document.getElementById('verifyForm');
const verifyBtn = document.getElementById('verifyBtn');
const resendBtn = document.getElementById('resendBtn');
const errorBanner = document.getElementById('errorBanner');
const successBanner = document.getElementById('successBanner');

function clearBanners(){
    errorBanner.classList.remove('show');
    successBanner.classList.remove('show');
    errorBanner.textContent = '';
    successBanner.textContent = '';
}

function clearFieldErrors(){
    document.querySelectorAll('.error').forEach(el => {
        el.textContent = '';
        el.classList.remove('show');
    });
}

function showFieldErrors(errors){
    // errors is Laravel's standard { field: [messages] } shape
    Object.keys(errors).forEach(field => {
        const el = document.getElementById(field + '-error');
        if(el){
            el.textContent = errors[field][0];
            el.classList.add('show');
        }
    });
}

async function postJson(url, data){
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    });

    let body = {};
    try {
        body = await response.json();
    } catch (e) {
        // non-JSON response (unexpected server error page etc.)
    }

    return { ok: response.ok, status: response.status, body };
}

verifyForm.addEventListener('submit', async function(e){

    e.preventDefault();
    clearBanners();
    clearFieldErrors();

    verifyBtn.disabled = true;
    verifyBtn.textContent = 'Verifying...';

    const payload = {
        email: document.getElementById('email').value,
        otp_code: document.getElementById('otp_code').value
    };

    try {

        const { ok, status, body } = await postJson(`${API_BASE}/verify-otp`, payload);

        if (ok) {

            successBanner.textContent = body.message || 'Account verified successfully!';
            successBanner.classList.add('show');

            // redirect to login after a short pause so the user sees the message
            setTimeout(() => {
                window.location.href = '/login';
            }, 1200);

        } else if (status === 422 && body.errors) {

            showFieldErrors(body.errors);
            errorBanner.textContent = body.message || 'Please fix the errors below.';
            errorBanner.classList.add('show');

        } else {

            errorBanner.textContent = body.message || 'Something went wrong. Please try again.';
            errorBanner.classList.add('show');

        }

    } catch (err) {

        errorBanner.textContent = 'Network error. Please check your connection and try again.';
        errorBanner.classList.add('show');

    } finally {

        verifyBtn.disabled = false;
        verifyBtn.textContent = 'Verify Account';

    }

});


resendBtn.addEventListener('click', async function(e){

    e.preventDefault();

    clearBanners();
    clearFieldErrors();

    const email = document.getElementById('email').value;

    const { ok, status, body } = await postJson(resendBtn.getAttribute('href'), { email });

    if (ok) {

        successBanner.textContent = body.message || 'A new OTP has been sent to your email.';
        successBanner.classList.add('show');

    } else if (status === 422 && body.errors) {

        showFieldErrors(body.errors);
        errorBanner.textContent = 'Please fix the errors below.';
        errorBanner.classList.add('show');

    } else {

        // covers 401 (invalid credentials) and 400 (already verified / wrong stage)
        errorBanner.textContent = body.message || 'Could not resend OTP. Please try again.';
        errorBanner.classList.add('show');

    }

});

</script>


</body>

</html>