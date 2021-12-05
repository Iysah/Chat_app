window.onload = function () {
    const form = document.querySelector(".signup form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");
    
    form.onsubmit = (e)=> {
        e.preventDefault();
        //Preventing form from submitting
    }
    
    continueBtn.onclick = ()=> {
        // Ajax code starts here
        let xhr = new XMLHttpRequest();
        //XML objects
        xhr.open("POST", "php/signup.php", true);
        xhr.onload = ()=> {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "success") {
                        location.href = "users.php"
                    } else {
                        errorText.style.display = "block";
                        errorText.textContent = data;
                    }
                }
            }
        }

        // SENDING FORM DATA WITH AJAX TO PHP
        let formData = new FormData(form);
        //Creating new form object
    
        xhr.send(formData);
    }
}
   