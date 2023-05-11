// Function to handle user sign up
function handleSignUp(event) {
    event.preventDefault(); // Prevent the form from submitting
  
    // Get the form data
    const form = event.target;
    const formData = new FormData(form);
  
    // Send a POST request to the backend to create a new user
    fetch("backend.php?route=users", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("User created successfully!");
        form.reset(); // Reset the form
      } else {
        alert("Error creating user.");
      }
    })
    .catch(error => {
      console.error(error);
      alert("Error creating user.");
    });
  }
  
  // Function to handle ride creation
  function handleAddRide(event) {
    event.preventDefault(); // Prevent the form from submitting
  
    // Get the form data
    const form = event.target;
    const formData = new FormData(form);
  
    // Send a POST request to the backend to create a new ride
    fetch("backend.php?route=rides", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("Ride added successfully!");
        form.reset(); // Reset the form
      } else {
        alert("Error adding ride.");
      }
    })
    .catch(error => {
      console.error(error);
      alert("Error adding ride.");
    });
  }
  
  // Function to fetch all rides from the backend and display them in the rides list
  function fetchRides() {
    fetch("backend.php?route=rides")
      .then(response => response.json())
      .then(data => {
        const rides = data.rides;
        const ridesList = document.getElementById("rides");
        for (let i = 0; i < rides.length; i++) {
          const ride = rides[i];
          const li = document.createElement("li");
          li.innerHTML = `Origin: ${ride.origin}, Destination: ${ride.destination}, Date: ${ride.date}, Seats Available: ${ride.seats}, Driver ID: ${ride.driver_id}`;
          ridesList.appendChild(li);
        }
      });
  }
  
  // Add event listeners for the signup and ride creation forms
  const signUpForm = document.getElementById("signup-form");
  signUpForm.addEventListener("submit", handleSignUp);
  
  const addRideForm = document.getElementById("add-ride-form");
  addRideForm.addEventListener("submit", handleAddRide);
  
  // Fetch all rides on page load
  fetchRides();
  