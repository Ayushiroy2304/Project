<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #FFBFA9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #FBFFB1;
    }

    .container label,
    .container input {
      display: block;
      margin-bottom: 10px;
      width: 70%;
      padding: 8px;
    }

    .container input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .container input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form id="loginForm" onsubmit="validateLogin(event)">
      <label for="email">Email:</label>
      <input type="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" required>

      <input type="submit" value="Login">
    </form>
    <div id="errorMessage" class="error"></div>
  </div>

  <script>
    function validateLogin(event) {
      event.preventDefault(); // Prevent form submission

      // Pre-defined credentials
      var validEmail = "admin@gmail.com";
      var validPassword = "admin";

      // Get the entered email and password
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      // Check if the entered credentials match the valid credentials
      if (email === validEmail && password === validPassword) {
        alert("Login successful!");
        document.getElementById("loginForm").reset(); // Clear form fields

        // Get the action and ID from the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const action = urlParams.get('action');
        const id = urlParams.get('id');

        // Perform the action based on the action and ID
        if (action === 'edit') {
          window.location.href = `edit.php?id=${id}`;
        } else if (action === 'delete') {
          if (confirm('Are you sure you want to delete this employee?')) {
            fetch(`delete.php?id=${id}`)
              .then(() => {
                alert('Employee deleted successfully!');
                window.location.href = 'action.php'; // Redirect to the user list page
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }
        }
      } else {
        document.getElementById("errorMessage").textContent = "Invalid email or password. Please try again.";
      }
    }
  </script>
</body>
</html>

