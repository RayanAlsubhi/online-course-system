function validateForm(){
    let errors = [];

    let name = document.forms['regForm']['name'].value;
    let email = document.forms['regForm']['email'].value;
    let password = document.forms['regForm']['password'].value;

    if(name.trim() === "") errors.push("Name is required");
    if(email.trim() === "") errors.push("Email is required");
    if(password.length < 6) errors.push("Password must be 6+ characters");

    if(errors.length > 0){
        alert("Please fix the following errors:\n\n" + errors.join("\n"));
        return false;
    }

    return true;
}


/* LOGIN VALIDATION */
function validateLogin(){
    let errors = [];

    let email = document.forms['loginForm']['email'].value;
    let password = document.forms['loginForm']['password'].value;

    if(email.trim() === ""){
        errors.push("Email is required");
    }

    if(password.trim() === ""){
        errors.push("Password is required");
    }

    if(errors.length > 0){
        alert("Please fix the following errors:\n\n" + errors.join("\n"));
        return false;
    }

    return true;
}


/* PROFILE VALIDATION */
function validateProfile(){
    let name = document.forms['profileForm']['name'].value;

    if(name.trim() === ""){
        alert("Please fix the following error:\n\nName cannot be empty");
        return false;
    }

    return true;
}