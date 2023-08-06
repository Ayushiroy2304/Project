function sendEmail() {
    // Make an AJAX request to the server-side PHP script
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "send_email.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from the server if needed
        console.log(xhr.responseText);
      }
    };
    xhr.send();
  }
  