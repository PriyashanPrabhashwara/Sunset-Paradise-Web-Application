<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Booking in Sri Lanka</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url('https://www.highreshdwallpapers.com/wp-content/uploads/2014/08/Beautiful-Beach-Side-View-1280x960.jpg');
    background-size: cover;
    
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 156%;
    background: rgba(0, 0, 0, 0.6); /* Adjust the opacity (0.6) as needed */
    z-index: -1;
}
        .container { max-width: 800px; margin: 50px auto; padding: 20px; background: rgba(0, 0, 0, 0.6); border-radius: 10px; box-shadow: 0px 5px 15px rgba(0,0,0,0.2); }
        h2 { text-align: center; color: white; }
        input, select{ width: 97%; padding: 10px; margin-top: 10px; border: 1px solid #ddd; border-radius: 5px;background-color: #ddd; }
        button {width: 100%; background: #ff9800; color: white; font-size: 16px; cursor: pointer;padding: 10px; margin-top: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button:hover { background: #e68900; }
        label{color: #f1f1f1;}
        #map { height: 300px; border-radius: 5px; margin-top: 10px; }
        #fareEstimate { font-weight: bold; color: green; text-align: center; margin-top: 10px; }
        .suggestions { position: absolute; width: 100%; background: white; max-height: 150px; overflow-y: auto; }
        .suggestions div { padding: 10px; cursor: pointer; }
        .suggestions div:hover { background: #f1f1f1; }
        .vehicle-selection {
    text-align: center;
    margin: 20px 0;
}

.vehicles {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.vehicle-card {
    width: 150px;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s ease;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    background: white;
}

.vehicle-card img {
    width: 100px;
    height: auto;
}

.vehicle-card p {
    font-size: 16px;
    font-weight: bold;
    margin-top: 8px;
}

.vehicle-card:hover {
    transform: scale(1.05);
    border-color: #ff6600;
}
.vehicle-card.selected {
    border-color: #ff6600;
    background: #fff4e6;
    box-shadow: 0px 0px 15px rgba(255, 102, 0, 0.6);
}
    </style>
</head>
<body>

<div class="container">
    <h2>Taxi Booking (Sri Lanka)</h2>

    <div class="vehicle-selection">
    <h3 style="color:#ff6600;">Select Your Vehicle</h3>
    <div class="vehicles">
        <div class="vehicle-card" data-vehicle="Car" data-price="200">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSECDEiHIXdHIk12pWVoIe_10UL0eofh7V0JNw2bDXKGIsfLJT29TH1HlP7nZmfiyR6Kmw&usqp=CAU" alt="Car">
            <p>Car - Rs.200</p>
            <p>(Price-Per-KM)</p>
        </div>
        <div class="vehicle-card" data-vehicle="Van" data-price="300">
            <img src="https://www.lankaholidays.com/pics/36527/KDH%20200%20.jpg" alt="Van">
            <p>Van - Rs.300</p>
            <p>(Price-Per-KM)</p>
        </div>
    
        <div class="vehicle-card" data-vehicle="MiniVan" data-price="500">
            <img src="https://www.vanhiresrilanka.com/images-self-drive/Vans/mini-van-self-drive.JPG" alt="MiniBus">
            <p>Mini Bus - Rs.500</p>
            <p>(Price-Per-KM)</p>
        </div>
    </div>
</div>

    <label>Pickup Location:</label>
    <input type="text" value="Unawatuna, Sri Lanka" disabled><br><br>

    <label>Destination (Type or Click on Map):</label>
    <input type="text" id="destinationSearch" placeholder="Type a location..." autocomplete="off">
    <div id="suggestions" class="suggestions"></div>

    <br><br>
    <label>Pickup Date & Time:</label>
    <input type="datetime-local" id="date">

    <div id="map"></div>

    <div id="fareEstimate"></div>

    <button id="bookNow">Book Now</button>
</div>

<!-- Leaflet.js -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    const baseFare = 500;
    const perKmRate = { Car: 200, Van: 300, MiniVan: 500 };

    const pickupLat = 6.0097, pickupLng = 80.2495;

    let destinationLat = null, destinationLng = null;

    var map = L.map('map').setView([pickupLat, pickupLng], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    L.marker([pickupLat, pickupLng]).addTo(map).bindPopup("Unawatuna, Sri Lanka").openPopup();
    let destinationMarker = null;
    map.on('click', function(e) {
        let lat = e.latlng.lat;
        let lng = e.latlng.lng;
        if (destinationMarker) map.removeLayer(destinationMarker);
        destinationMarker = L.marker([lat, lng]).addTo(map).bindPopup("Destination").openPopup();
        destinationLat = lat;
        destinationLng = lng;
        calculateDistance();
    });
    function calculateDistance() {
    if (destinationLat === null || destinationLng === null) return;

    const R = 6371;
    const dLat = (destinationLat - pickupLat) * (Math.PI / 180);
    const dLng = (destinationLng - pickupLng) * (Math.PI / 180);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(pickupLat * (Math.PI / 180)) * Math.cos(destinationLat * (Math.PI / 180)) *
        Math.sin(dLng / 2) * Math.sin(dLng / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distance = R * c;

    let selectedCard = document.querySelector(".vehicle-card.selected");
    if (!selectedCard) {
        document.getElementById("fareEstimate").innerHTML = "Please select a vehicle!";
        return;
    }
    let vehicleType = selectedCard.getAttribute("data-vehicle");
    let fare = baseFare + (distance * perKmRate[vehicleType]);
    document.getElementById("fareEstimate").innerHTML = 
        `<strong>Estimated Fare:</strong> LKR ${Math.round(fare)} 
        <br> <small>Distance: ${distance.toFixed(2)} KM</small>`;
}


document.getElementById("bookNow").addEventListener("click", function () {
    let destination = document.getElementById("destinationSearch").value;
    let date = document.getElementById("date").value;
    let selectedCard = document.querySelector(".vehicle-card.selected");
    if (!selectedCard) {
        Swal.fire("Error", "Please select a vehicle!", "error");
        return;
    }
    let vehicleType = selectedCard.getAttribute("data-vehicle");
    let vehicleImage = selectedCard.querySelector("img").src;
    let fareEstimate = document.getElementById("fareEstimate").innerHTML;
    let price = document.getElementById("fareEstimate").innerText.match(/LKR (\d+)/)[1]; // Extracts only the numeric value
    if (!destination || !date) {
        Swal.fire("Error", "Please enter a destination and select a date!", "error");
        return;
    }
    Swal.fire({
        title: "Confirm Your Booking",
        html: `
            <div style="text-align: center; font-family: Arial, sans-serif;">
                <img src="${vehicleImage}" alt="${vehicleType}" style="width: 100px; height: auto; margin-bottom: 10px;">
                <h3 style="color: #ff6600; margin-bottom: 5px;">${vehicleType}</h3>
                <p><strong>From:</strong> Unawatuna, Sri Lanka</p>
                <p><strong>To:</strong> ${destination}</p>
                <p><strong>Date & Time:</strong> ${date}</p>
                <div style="background: #f7f7f7; padding: 10px; border-radius: 8px; font-size: 18px; color: #333;">
                    <strong>${fareEstimate}</strong>
                </div>
            </div>
        `,
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Confirm Booking",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#ff6600",
        cancelButtonColor: "#888"
    }).then((result) => {
        if (result.isConfirmed) {
            submitBooking(destination, date, vehicleType, price, fareEstimate, vehicleImage);
        }
    });
});

// Function to send booking details to the backend
function submitBooking(destination, date, vehicleType, price, fareEstimate, vehicleImage) {
    fetch("taxi_booking_confirm.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            destination: destination,
            date: date,
            vehicle: vehicleType,
            price: price,
            fare: fareEstimate,
            vehicle_image: vehicleImage
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire("Success!", "Your booking has been confirmed. Check your email for details.", "success").then(() => {
                location.reload(); // Reload to reflect changes
            });
        } else {
            Swal.fire("Error", data.message || "Booking failed. Please try again later.", "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire("Error", "An unexpected error occurred.", "error");
    });
}



    document.getElementById("destinationSearch").addEventListener("input", function() {
    let query = this.value.trim();
    let suggestionsDiv = document.getElementById("suggestions");

    if (query.length === 0) {
        suggestionsDiv.innerHTML = "";
        return;
    }
    clearTimeout(this.searchTimer);
    this.searchTimer = setTimeout(() => {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&countrycodes=LK&q=${query}`)
            .then(response => response.json())
            .then(data => {
                suggestionsDiv.innerHTML = "";
                data.forEach(place => {
                    let suggestion = document.createElement("div");
                    suggestion.textContent = place.display_name;
                    suggestion.addEventListener("click", function() {
                        document.getElementById("destinationSearch").value = place.display_name;
                        suggestionsDiv.innerHTML = "";
                        destinationLat = parseFloat(place.lat);
                        destinationLng = parseFloat(place.lon);
                        if (destinationMarker) map.removeLayer(destinationMarker);
                        destinationMarker = L.marker([destinationLat, destinationLng]).addTo(map).bindPopup(place.display_name).openPopup();
                        map.setView([destinationLat, destinationLng], 14);
                        calculateDistance();
                    });
                    suggestionsDiv.appendChild(suggestion);
                });
            });
    }, 300); // 🕐 Wait 300ms before making the request (prevents spam requests)
});




document.querySelectorAll(".vehicle-card").forEach(card => {
    card.addEventListener("click", function () {
        document.querySelectorAll(".vehicle-card").forEach(v => v.classList.remove("selected"));
        this.classList.add("selected");

        selectedVehicle = this.getAttribute("data-vehicle");
        selectedPrice = this.getAttribute("data-price");

        console.log("Selected Vehicle:", selectedVehicle, "Price:", selectedPrice);
    });
});

</script>

</body>
</html>
