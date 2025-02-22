document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Останавливаем стандартное действие формы

    // Получаем введенные значения
    let username = document.getElementById("user").value;
    let password = document.getElementById("pass").value;

    // Проверка (замени на свою систему аутентификации)
    if (username === "admin" && password === "1234") {
        alert("Veiksmīga pieteikšanās!"); // Уведомление об успешном входе
        window.location.href = "forum.html"; // Переход на форум
    } else {
        alert("Nepareizs lietotājvārds vai parole!"); // Ошибка
    }
});
