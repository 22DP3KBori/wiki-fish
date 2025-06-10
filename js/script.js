document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let username = document.getElementById("user").value;
    let password = document.getElementById("pass").value;

    if (username === "admin" && password === "1234") {
        alert("Veiksmīga pieteikšanās!");
        window.location.href = "forum.html";
    } else {
        alert("Nepareizs lietotājvārds vai parole!");
    }
});
