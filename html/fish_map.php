<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makšķerēšanas vietas</title>
    <link rel="stylesheet" href="/css/style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
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
        </div>
    </div>
    
    <div class="topic">
        <h1>Makšķerēšanas vietas</h1>
    </div>

    <div id="map"></div>

    <script>
        let map;
        let geocoder;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 56.9496, lng: 24.1052 },
                zoom: 7,
            });
            geocoder = new google.maps.Geocoder();
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDknPY6ttHWymt7OMAEjD4v_Scpq8UkTGk&callback=initMap"></script>

    <div class="ad">
        <i class="fas fa-lightbulb"></i>
        Vēlies ieteikt makšķerēšanas vietu!? Tad dodies uz sadaļu Temas un atver tēmu Priekšlikumi!
    </div>

</body>

<footer class="sticky-footer">
        <div class="social-icons">
            <a href="https://twitter.com" class="twitter"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://facebook.com" class="facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" class="instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://youtube.com" class="youtube"><i class="fa-brands fa-youtube"></i></a>
        </div>
</footer>

</html>
