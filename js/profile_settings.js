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
        // Update file name display
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("avatar").addEventListener("change", function() {
                var fileName = this.files[0] ? this.files[0].name : "Nav izvēlēts fails";
                document.getElementById("file-name").textContent = fileName;
            });
        });