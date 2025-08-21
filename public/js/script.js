const icon = document.querySelector(".icon");
const passwordInput = document.querySelector(".password");

icon.addEventListener("click", () => {
    // show password
    passwordInput.type = passwordInput.type == "password" ? "text" : "password";

    // change the icon
    if (icon.classList.contains("fa-eye")) {
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }

    // change icon title
    icon.title =
        icon.title == "show password" ? "hide password" : "show password";
});
