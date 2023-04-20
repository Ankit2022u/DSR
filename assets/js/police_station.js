function update_police_stations() {
    console.log("Button Clicked");
    // Get the selected district value
    var district = document.getElementById("district").value;

    // Update the police_station select options based on the selected district
    var policeStationSelect = document.getElementById("police_station");
    policeStationSelect.innerHTML = ""; // Clear existing options

    // If district is selected, fetch police_stations from the server based on the selected district
    if (district !== "") {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var police_stations = JSON.parse(xhr.responseText);
                    for (var i = 0; i < police_stations.length; i++) {
                        var option = document.createElement("option");
                        option.value = police_stations[i].police_station;
                        option.text = police_stations[i].police_station;
                        policeStationSelect.add(option);
                    }
                } else {
                    console.error("Failed to fetch police_stations. Error code: " + xhr.status);
                }
            }
        };
        xhr.open("POST", "../api/fetch_police_stations.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("district=" + district);
    }
}