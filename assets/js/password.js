function changeIcon(state) {
    if (state == 1) {
        var bool = document.getElementById("old_password");
        var icon = document.getElementById("icon1");
        if (bool.type === "password") {
            bool.type = 'text';
            icon.className = 'bi bi-eye-slash-fill';
        } else {
            bool.type = 'password';
            icon.className = 'bi bi-eye-fill';
        }
    }

    else if (state == 2) {
        var bool = document.getElementById("new_password");
        var icon = document.getElementById("icon2");
        if (bool.type === "password") {
            bool.type = 'text';
            icon.className = 'bi bi-eye-slash-fill';
        } else {
            bool.type = 'password';
            icon.className = 'bi bi-eye-fill';
        }
    }

    else if (state == 3) {
        var bool = document.getElementById("confirm_new_password");
        var icon = document.getElementById("icon3");
        if (bool.type === "password") {
            bool.type = 'text';
            icon.className = 'bi bi-eye-slash-fill';
        } else {
            bool.type = 'password';
            icon.className = 'bi bi-eye-fill';
        }
    }

    else if (state == 4) {
        var bool = document.getElementById("password");
        var icon = document.getElementById("icon4");
        if (bool.type === "password") {
            bool.type = 'text';
            icon.className = 'bi bi-eye-slash-fill';
        } else {
            bool.type = 'password';
            icon.className = 'bi bi-eye-fill';
        }
    }

}