<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makšķernieka Forums</title>
    <link rel="stylesheet" href="/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <script>
        function toggleSearch(event) {
            var searchBox = document.getElementById("searchBox");
            searchBox.style.display = searchBox.style.display === "block" ? "none" : "block";
            event.stopPropagation();
        }
        document.addEventListener("click", function(event) {
            var searchBox = document.getElementById("searchBox");
            if (searchBox.style.display === "block" && !searchBox.contains(event.target) && event.target.className !== "search-button") {
                searchBox.style.display = "none";
            }
        });
    </script>
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <div class="logo">Makšķernieka Forums</div>
            <a href="#"><i class="fas fa-home"></i> Sākums</a>
            <a href="#"><i class="fas fa-comments"></i> Temas</a>
            <a href="fish_map.php"><i class="fas fa-fish"></i> Makšķerēšanas vietas</a>
        </div>

        <div class="nav-right">
            <a href="index.php"><i class="fas fa-user"></i> Pieteikties</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Reģistrēties</a>
            <a href="#" class="search-button" onclick="toggleSearch(event)"><i class="fas fa-search"></i> Meklēt</a>
        </div>
    </div>


    <div class="container">
        <h1><strong>Laipni lūdzam Makšķernieku forumā!</strong></h1>
        <p><em>Šeit jūs varat apmainīties ar pieredzi, padomiem un atradumiem ar visiem citiem makšķerniekiem.</em></p>

        <hr>

        <h2>❓ Ko jūs šeit atradīsit?</h2>

        <h3>🎣 Makšķerēšanas vietas</h3>
        <p>Skatiet labākās makšķerēšanas vietas, izlasiet citu cilvēku viedokļus un pievienojiet savus atradumus.</p>

        <h3>💬 Foruma tēmas</h3>
        <p>Saruna par makšķerēšanas tehniku, aprīkojumu un tendencēm.</p>

        <h3>🛒 Pirkt/Pārdod</h3>
        <p>Sludinājumu sadaļa, kur var apmainīt vai iegādāties makšķerēšanas aprīkojumu.</p>

        <hr>

        <h2>⚠️ Foruma noteikumi:</h2>

        <h3>✔️ Esiet pieklājīgs</h3>
        <p>Cieniet citus foruma dalībniekus un viņu viedokli.</p>

        <h3>🚫 Nav surogātpasta</h3>
        <p>Visi sludinājumi vai ziņas, kas nav saistītas ar tēmu, tiks nekavējoties izdzēstas.</p>

        <h3>📢 Dalieties pieredzē</h3>
        <p>Jūsu padoms var palīdzēt citiem makšķerniekiem!</p>

        <hr>

        <h2>📢 Seko mums sociālajos tīklos!</h2>
        <p><em>Abonējiet mūsu kopienu un sekojiet jaunumiem sociālajos tīklos.</em></p>
    </div>

    <div id="searchBox" class="search-container">
        <label for="search">Meklēt:</label>
        <input type="text" id="search" placeholder="Atslēgvārds...">
        <div id="searchBox-checkbox" class="searchBoxas">
            <input type="checkbox" name="c[title_only]" value="1">
            <label for="title-search">Tikai virsrakstos</label>
        </div>
        <label for="author">Autors:</label>
        <input type="text" id="author" placeholder="Autors...">
    </div>

    <footer class="sticky-footer">
        <div class="social-icons">
            <a href="https://twitter.com" class="twitter"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://facebook.com" class="facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" class="instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://youtube.com" class="youtube"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </footer>


</body>
</html>
