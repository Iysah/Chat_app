$("document").ready(function () {
    // PASSWORD SHOW AND HIDE BUTTON
    const pswdField = document.querySelector(".form .field input[type='password']"), 
    toggleBtn = document.querySelector('.form .field i');
    
    toggleBtn.onclick = () => {
        if(pswdField.type == "password") {
            pswdField.type = "text";
            toggleBtn.classList.add("active");
            // console.log("Hello, whats up!");
        } else {
            pswdField.type = "password";
            toggleBtn.classList.remove("active");
        }
    }    
});

