function validateForm(event) {
    event.preventDefault();

    const form = document.forms["signupForm"];
    const name = form["name"].value.trim();
    const email = form["email"].value.trim();
    const password = form["password"].value;

    if (name === "") {
        alert("Please enter your name");
        return false;
    }

    if (password.length < 8) {
        alert("Password should be at least 8 characters");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[a-z]{2,3}$/;
    if (!emailPattern.test(email)) {
        alert("Enter correct email");
        return false;
    }

    form.submit();
}