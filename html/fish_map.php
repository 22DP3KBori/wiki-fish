<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makšķerēšanas vietas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #222;
            color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            margin-top: 20px;
        }
        #map {
            width: 80%;
            height: 500px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
        .form-container {
            margin: 20px auto;
            width: 50%;
            background: #333;
            padding: 15px;
            border-radius: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #00aaff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #0088cc;
        }
    </style>
</head>
<body>
    
    <h1>Makšķerēšanas vietas</h1>
    <p>Pievieno savu iecienītāko makšķerēšanas vietu!</p>
    
    <div id="map"></div>
    
    <div class="form-container">
        <input type="text" id="address" placeholder="Ievadi adresi...">
        <input type="text" id="fish" placeholder="Kāda zivs šeit ir?">
        <input type="number" id="depth" placeholder="Dziļums (m)">
        <label><input type="checkbox" id="boat"> Var makšķerēt ar laivu</label>
        <textarea id="description" placeholder="Apraksts..."></textarea>
        <button onclick="geocodeAddress()">Pievienot vietu</button>
    </div>

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

        function geocodeAddress() {
            let address = document.getElementById("address").value;
            let fish = document.getElementById("fish").value;
            let depth = document.getElementById("depth").value;
            let boat = document.getElementById("boat").checked ? "Jā" : "Nē";
            let description = document.getElementById("description").value;

            if (!address) {
                alert("Lūdzu, ievadiet adresi!");
                return;
            }
            
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                    let location = results[0].geometry.location;
                    let marker = new google.maps.Marker({
                        map: map,
                        position: location,
                    });
                    let infoWindow = new google.maps.InfoWindow({
                        content: `<strong>Adrese:</strong> ${address}<br>
                                  <strong>Zivis:</strong> ${fish}<br>
                                  <strong>Dziļums:</strong> ${depth} m<br>
                                  <strong>Laiva:</strong> ${boat}<br>
                                  <strong>Apraksts:</strong> ${description}`
                    });
                    marker.addListener("click", () => {
                        infoWindow.open(map, marker);
                    });
                    
                    map.setCenter(location);
                    map.setZoom(10);
                } else {
                    alert("Adrese netika atrasta: " + status);
                }
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDknPY6ttHWymt7OMAEjD4v_Scpq8UkTGk&callback=initMap"></script>

</body>
</html>
