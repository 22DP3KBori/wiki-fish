<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temas - Makšķernieku Forums</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style4.css">
</head>
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
            <a href="forum.php"><i class="fas fa-home"></i> Sākums</a>
            <a href="topic.php"><i class="fas fa-comments"></i> Temas</a>
            <a href="fish_map.php"><i class="fas fa-fish"></i> Makšķerēšanas vietas</a>
            <a href="record.php"><i class="fas fa-trophy"></i> Rekordu tabula</a>
        </div>

        <div class="nav-right">
            <a href="index.php"><i class="fas fa-user"></i> Pieteikties</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Reģistrēties</a>
            <a href="#" class="search-button" onclick="toggleSearch(event)"><i class="fas fa-search"></i> Meklēt</a>
        </div>
    </div>

    <div class="container">
        <div class="section-title">Foruma noteikumi</div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Vispārīgi foruma noteikumi</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Tēmu un apakštēmu veidošanas noteikumi</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-title">Zvejas ziņojumi</div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Globālās ziņas</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Reģionālās ziņas</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-title">Ekipējums un apskati</div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Makšķeres</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Mānekļi</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Spoles</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-title">Padomi iesācējiem</div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Iesācēju stūrītis</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-comment tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">off-topic</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        
    </div>

    <div class="container">
        <div class="section-title">Tehniskais atbalsts</div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-bug tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Ziņot par vietnes kļūdu</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-circle-info tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Palīdzība</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>

        <div class="tema-box">
            <div class="tema-left">
                <i class="fas fa-lightbulb tema-icon"></i>
                <div class="tema-info">
                    <div class="tema-title"><a href="#">Piedāvājumi</a></div>
                    <div class="tema-meta">Temas: 45 | Ziņas: 230</div>
                </div>
            </div>
            <div class="tema-right">
                Jaunākais: <strong>Jānis</strong>
            </div>
        </div>



        
    </div>


    <div id="searchBox" class="search-container">
        <label for="search">Meklēt:</label>
        <input type="text" id="search" placeholder="Atslēgvārds..."><br><br>
        <div id="searchBox-checkbox" class="searchBoxas">
            <input type="checkbox" name="c[title_only]" value="1">
            <label for="title-search">Tikai virsrakstos</label><br><br>
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
