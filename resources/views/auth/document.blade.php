<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Upload Documents</title>


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

    max-width:600px;

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

    margin-bottom:25px;

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



/* Existing documents list */

.doc-list{

    margin-bottom:25px;

}


.doc-item{

    display:flex;

    justify-content:space-between;

    align-items:center;

    background:#f1f3f6;

    border-radius:12px;

    padding:14px 15px;

    margin-bottom:10px;

}


.doc-item .doc-info{

    display:flex;

    flex-direction:column;

}


.doc-item .doc-category{

    font-size:12px;

    color:#667eea;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:.5px;

}


.doc-item .doc-name{

    font-size:14px;

    color:#333;

    margin-top:2px;

}


.status-badge{

    font-size:12px;

    padding:4px 12px;

    border-radius:20px;

    font-weight:600;

    text-transform:capitalize;

}


.status-badge.pending{

    background:#fff3cd;

    color:#8a6d00;

}


.status-badge.approved{

    background:#e6f7ee;

    color:#1a7f4e;

}


.status-badge.rejected{

    background:#fdecea;

    color:#e63946;

}


.empty-state{

    text-align:center;

    color:#999;

    font-size:14px;

    padding:20px 0;

}



.section-label{

    font-size:13px;

    color:#777;

    text-transform:uppercase;

    letter-spacing:.5px;

    margin-bottom:12px;

    font-weight:600;

}




.form-group{

    position:relative;

    margin-top:8px;

    margin-bottom:20px;

}





.form-group input[type="text"]{


    width:100%;


    padding:14px 15px;


    border:none;


    outline:none;


    border-radius:12px;


    background:#f1f3f6;


    font-size:15px;


    transition:.3s;

}



.form-group input[type="text"]:focus{


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




.form-group input[type="text"]:focus + label,
.form-group input[type="text"]:valid + label{

    top:-10px;

    left:12px;

    font-size:12px;

    color:#667eea;

    background:#fff;

}



/* Custom file input */

.file-drop{

    position:relative;

    border:2px dashed #cfd4e0;

    border-radius:12px;

    padding:20px 15px;

    text-align:center;

    background:#f8f9fb;

    transition:.3s;

    cursor:pointer;

}


.file-drop.has-file{

    border-color:#667eea;

    background:#eef0fd;

}


.file-drop input[type="file"]{

    position:absolute;

    inset:0;

    opacity:0;

    cursor:pointer;

}


.file-drop .file-label{

    font-size:14px;

    color:#666;

}


.file-drop .file-label strong{

    color:#667eea;

}


.file-drop .file-name{

    font-size:13px;

    color:#333;

    margin-top:6px;

    font-weight:600;

    word-break:break-all;

}



.doc-block{

    border:1px solid #eef0f5;

    border-radius:14px;

    padding:18px;

    margin-bottom:20px;

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


.hint{

    font-size:12px;

    color:#999;

    margin-top:8px;

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

<h2>Upload Documents</h2>

<p>Upload your ID Proof and KRA PIN to complete verification</p>

</div>



<div id="errorBanner" class="banner error-banner"></div>
<div id="successBanner" class="banner success-banner"></div>



<div class="section-label">Current Documents</div>

<div class="doc-list" id="docList">
<div class="empty-state">Loading documents...</div>
</div>




<form id="documentForm">

<div class="doc-block">

<div class="section-label">PAN CARD</div>

<div class="file-drop" id="id_proof_drop">
<input type="file" id="id_proof_file" name="id_proof_file" accept=".pdf,.jpg,.jpeg,.png" required>
<div class="file-label"><strong>Click to upload</strong> or drag a file here</div>
<div class="file-name" id="id_proof_filename"></div>
</div>

<div class="hint">PDF, JPG, or PNG — max 10MB</div>

<span class="error" id="id_proof_file-error"></span>

</div>




<div class="doc-block">

<div class="section-label">Aadhar Number</div>

<div class="file-drop" id="kra_pin_drop">
<input type="file" id="kra_pin_file" name="kra_pin_file" accept=".pdf,.jpg,.jpeg,.png" required>
<div class="file-label"><strong>Click to upload</strong> or drag a file here</div>
<div class="file-name" id="kra_pin_filename"></div>
</div>

<div class="hint">PDF, JPG, or PNG — max 10MB</div>

<span class="error" id="kra_pin_file-error"></span>

</div>




<button type="submit" class="submit-btn" id="uploadBtn">

Upload Documents

</button>



</form>


</div>


</div>


<script>

const API_BASE = '/api';

const form = document.getElementById('documentForm');
const uploadBtn = document.getElementById('uploadBtn');
const errorBanner = document.getElementById('errorBanner');
const successBanner = document.getElementById('successBanner');
const docList = document.getElementById('docList');

const fieldNames = ['id_proof_file', 'kra_pin_file'];

// tracks whether documents already exist, so we know upload vs reupload
let hasExistingDocuments = false;

function authHeaders(extra = {}){
    const token = sessionStorage.getItem('auth_token');
    return {
        'Accept': 'application/json',
        ...(token ? { 'Authorization': `Bearer ${token}` } : {}),
        ...extra
    };
}

function clearBanners(){
    errorBanner.classList.remove('show');
    successBanner.classList.remove('show');
    errorBanner.textContent = '';
    successBanner.textContent = '';
}

function clearFieldErrors(){
    fieldNames.forEach(field => {
        const el = document.getElementById(field + '-error');
        if(el){
            el.textContent = '';
            el.classList.remove('show');
        }
    });
}

function showFieldErrors(errors){
    Object.keys(errors).forEach(field => {
        const el = document.getElementById(field + '-error');
        if(el){
            el.textContent = errors[field][0];
            el.classList.add('show');
        }
    });
}

function statusBadgeClass(status){
    const s = (status || 'pending').toLowerCase();
    if (s === 'approved') return 'approved';
    if (s === 'rejected') return 'rejected';
    return 'pending';
}

async function loadDocuments(){

    try {

        const response = await fetch(`/${API_BASE}/documents`, {
            method: 'GET',
            headers: authHeaders()
        });

        const body = await response.json();

        if (!response.ok) {
            docList.innerHTML = `<div class="empty-state">${body.message || 'No existing documents.'}</div>`;
            return;
        }

        const docs = body.data || [];

        if (docs.length === 0) {
            hasExistingDocuments = false;
            docList.innerHTML = '<div class="empty-state">No documents uploaded yet.</div>';
            uploadBtn.textContent = 'Upload Documents';
            return;
        }

        hasExistingDocuments = true;
        uploadBtn.textContent = 'Re-upload Documents';

        docList.innerHTML = docs.map(doc => `
            <div class="doc-item">
                <div class="doc-info">
                    <span class="doc-category">${doc.document_category}</span>
                    <span class="doc-name">${doc.document_name}</span>
                </div>
                <span class="status-badge ${statusBadgeClass(doc.current_status)}">${doc.current_status}</span>
            </div>
        `).join('');

    } catch (err) {
        docList.innerHTML = '<div class="empty-state">No existing documents.</div>';
    }

}

function setupFileDrop(dropId, inputId, filenameId){

    const drop = document.getElementById(dropId);
    const input = document.getElementById(inputId);
    const filenameEl = document.getElementById(filenameId);

    input.addEventListener('change', function(){
        if (input.files && input.files.length > 0) {
            drop.classList.add('has-file');
            filenameEl.textContent = input.files[0].name;
        } else {
            drop.classList.remove('has-file');
            filenameEl.textContent = '';
        }
    });

}

setupFileDrop('id_proof_drop', 'id_proof_file', 'id_proof_filename');
setupFileDrop('kra_pin_drop', 'kra_pin_file', 'kra_pin_filename');

form.addEventListener('submit', async function(e){

    e.preventDefault();
    clearBanners();
    clearFieldErrors();

    uploadBtn.disabled = true;
    const originalText = uploadBtn.textContent;
    uploadBtn.textContent = 'Uploading...';

    const formData = new FormData();
    formData.append('id_proof_file', document.getElementById('id_proof_file').files[0]);
    formData.append('kra_pin_file', document.getElementById('kra_pin_file').files[0]);

    const endpoint = hasExistingDocuments ? 'user/documents-reupload' : 'user/documents-upload';

    try {

        const response = await fetch(`${API_BASE}/${endpoint}`, {
            method: 'POST',
            headers: authHeaders(), // do NOT set Content-Type manually - browser sets multipart boundary
            body: formData
        });

        let body = {};
        try { body = await response.json(); } catch (err) {}

        if (response.ok) {

            successBanner.textContent = body.message || 'Documents uploaded successfully.';
            successBanner.classList.add('show');

            await loadDocuments();

            form.reset();
            document.querySelectorAll('.file-drop').forEach(d => d.classList.remove('has-file'));
            document.querySelectorAll('.file-name').forEach(f => f.textContent = '');

        } else if (response.status === 401) {

            errorBanner.textContent = 'Your session has expired. Please log in again.';
            errorBanner.classList.add('show');

        } else if (response.status === 403) {

            errorBanner.textContent = body.message || 'This action is not allowed at this stage.';
            errorBanner.classList.add('show');

        } else if (response.status === 422 && body.errors) {

            showFieldErrors(body.errors);
            errorBanner.textContent = 'Please fix the errors below.';
            errorBanner.classList.add('show');

        } else {

            errorBanner.textContent = body.message || 'Something went wrong. Please try again.';
            errorBanner.classList.add('show');

        }

    } catch (err) {

        errorBanner.textContent = 'Network error. Please check your connection and try again.';
        errorBanner.classList.add('show');

    } finally {

        uploadBtn.disabled = false;
        uploadBtn.textContent = hasExistingDocuments ? 'Re-upload Documents' : originalText;

    }

});

// load existing documents on page load
loadDocuments();

</script>


</body>

</html>