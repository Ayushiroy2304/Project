<!DOCTYPE html>
<html>
<head>
  <title>User Details</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      background-color: #FFBFA9;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .actions {
      display: flex;
      justify-content: center;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2; /* Add background color to even rows */
    }

    h2 {
      color: #E57C23; /* Add the desired color code or name */
    }
  </style>
</head>
<body>
  <h2>User Details</h2>
  <table id="userdata">
    <tr>
      <th>ID</th>
      <th>Department</th> 
      <th>Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
  </table>

  <script>
    // Fetch data from the server
    function fetchData() {
      const urlParams = new URLSearchParams(window.location.search);
      const id = urlParams.get('id');

      fetch(`data.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
          const table = document.getElementById('userdata');

          // Clear previous data
          table.innerHTML = `
            <tr>
              <th>ID</th>
              <th>Department</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Email</th>
              <th>Phone</th>
            </tr>
          `;

          // Populate table with data
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${data.id}</td>
            <td>${data.department}</td>
            <td>${data.name}</td>
            <td>${data.gender}</td>
            <td>${data.email}</td>
            <td>${data.phone}</td>
          `;
          table.appendChild(row);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    // Fetch initial data
    fetchData();
  </script>
</body>
</html>
