<!DOCTYPE html>
<html>
<head>
<?php include 'header.php';?>
    <title>Railway Ticket Booking</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    

    <div class="search-container">

        <h1>Book Your Train <span>Escape</span> Now!</h1>
        <form class="search-form" action="searchresults.php" method="post">
            <div class="input-group">
                <label for="from">From:</label>
                <input type="text" id="from" name="from" placeholder="Departure Station">
                <div class="autocomplete-dropdown autocomplete-from" id="from-autocomplete"></div>
            </div>
            <div class="input-group">
                <label for="to">To:</label>
                <input type="text" id="to" name="to" placeholder="Arrival Station">
                <div class="autocomplete-dropdown autocomplete-to" id="to-autocomplete"></div>
            </div>
            <div class="input-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">
            </div>
            <button type="submit" id="search-button">SEARCH</button>
        </form>
        
    </div>
    <div class="benefits">
        <div class="row"> 
        <div class="el">
            <div class="img">
                <img src="./img/beach.png" alt="">
            </div>
            <div class="disc">
                <h3>Top Destinations</h3>
                <p>Discover premier destinations with unmatched allure.</p>


            </div>
        </div>
        <div class="el">
            <div class="img">
                <img style="width: 90px; height: 90px;" src="./img/wallet.png" alt="">
            </div>
            <div class="disc">
                <h3>The Best Prices</h3>
                <p>Unbeatable prices for exceptional value and quality.</p>

            </div>
        </div>
        <div class="el">
            <div class="img">
                <img  src="./img/suitcase.png" alt="">
            </div>
            <div class="disc">
                <h3>Amazing Service</h3>
                <p>Exemplary service that exceeds all expectations.</p>


            </div>
        </div>
        </div>
    </div>

    <div class="destinations">
        <h1>Popular Destinations</h1>
        <div class="place_box">
            <div class="place">
                <div class="p_img"><img src="./img/delhi.jpg" alt=""></div>
                <h2>Delhi</h2>
                <p1>The heart of vibrant India.</p1>
                <p>Price $100</p>
            </div>
            <div class="place">
                <div class="p_img"><img src="./img/chennai.jpg" alt=""></div>
                <h2>Chennai</h2>
                <p1>Cultural hub on India's coast.</p1>
                <p>Price $100</p>
            </div>
            <div class="place">
                <div class="p_img"><img src="./img/mumbai.jpg" alt=""></div>
                <h2>Mumbai</h2>
                <p1>Commercial capital with ocean charm.</p1>
                <p>Price $120</p>
            </div>
            
        </div>
    </div>

        <footer>
            <div class="contacts">
                <h1>Contact Us</h1>
                <div class="c_box">
                    <div class="c_elem">
                        <img src="./img/directions.png" alt="directions">
                        <h2>Give Us A Call</h2>
                        <p>Mobile: +44 5567 89 3322 332</p>      
                    </div>
                    <div class="c_elem">
                        <img src="./img/hiking.png" alt="directions">
                        <h2>Come & Drop By</h2>
                        <p>45°27'53.305" N 9°10'59.793" E</p>      
                    </div>
                    <div class="c_elem">
                        <img src="./img/dove2.png" alt="directions">
                        <h2>Send Us A Message </h2>
                        <p>pearssoapcolgate@gmail.com</p>      
                    </div>
                </div>
                <div class="copyr"><small>Copyright ©2023 All rights reserved</small></div>
            </div>
        </footer>

    <script defer>
        // Sample station names, replace with your actual data
        const stationNames = [ "Ernakulam", "Delhi", "Mumbai", "Chennai", "Kolkata", "Bangalore", "Hyderabad", 'Pune', "Mysore", "Jaipur", "Amritsar", "Secunderabad"];

   
        // Function to initialize autocomplete for an input field
        function initializeAutocomplete(inputId, dropdownId) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(dropdownId);
   
            input.addEventListener("input", function () {
                const inputValue = input.value.toLowerCase();
                const matchingStations = stationNames.filter((station) =>
                    station.toLowerCase().includes(inputValue)
                );
   
                // Clear previous suggestions
                dropdown.innerHTML = "";
   
                // Display matching station suggestions
                matchingStations.forEach((station) => {
                    const suggestion = document.createElement("div");
                    suggestion.innerText = station;
   
                    suggestion.addEventListener("click", function () {
                        input.value = station;
                        dropdown.innerHTML = "";
                    });
   
                    dropdown.appendChild(suggestion);
                });
            });
   
            document.addEventListener("click", function (event) {
                if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.innerHTML = "";
                }
            });
        }
   
        // Initialize autocomplete for "from" and "to" inputs
        initializeAutocomplete("from", "from-autocomplete");
        initializeAutocomplete("to", "to-autocomplete");

        document.addEventListener('DOMContentLoaded', function () {
        // Get the current date in the format "YYYY-MM-DD"
        const currentDate = new Date().toISOString().split('T')[0];

        // Set the current date as the default value for the input
        document.getElementById('date').value = currentDate;
    });
    </script>
   

</body>
</html>