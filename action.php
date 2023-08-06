<!--<!DOCTYPE html>
<html>
<head>
  <title>User List</title>
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

  .actions {
    display: flex;
    justify-content: center;
    h2 {
    color: #E57C23; /* Add the desired color code or name */
  }
  </style>
</head>
<body>
  <h2>User List</h2>
  <table id="userdata">
    <tr>
      <th>ID</th>
      <th>Department</th> 
      <th>Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone</th>
      <tr>
      <th> <p>Edit / Delete</p></th>
  </tr>
     
    </tr>
  </table>

  <script>
    // Fetch data from the server
    function fetchData() {
      fetch('data.php')
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
              <th>Edit / Delete</th>
        
            </tr>
          `;

          // Populate table with data
          data.forEach(userdata => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${userdata.id}</td>
              <td>${userdata.department}</td>
              <td>${userdata.name}</td>
              <td>${userdata.gender}</td>
              <td>${userdata.email}</td>
              <td>${userdata.phone}</td>
              <td class="actions">
                <button onclick="edituserdata(${userdata.id})">Edit</button>
              </td>
              <td class="actions">
                <button onclick="deleteuserdata(${userdata.id})">Delete</button>
              </td>
            `;
            table.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    // Delete employee by ID
    function deleteuserdata(id) {
      if (confirm('Are you sure you want to delete this employee?')) {
        fetch(`delete.php?id=${id}`)
          .then(() => {
            fetchData(); // Refresh the table
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    }

    // Edit employee by ID
    function edituserdata(id) {
      window.location.href = `edit.php?id=${id}`;
    }

    // Fetch initial data
    fetchData();
  </script>
</body>
</html>-->

<!DOCTYPE html>
<html>
<head>
  <title>User List</title>
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

  .actions {
    display: flex;
    justify-content: center;
    h2 {
    color: #E57C23; /* Add the desired color code or name */
  }
  </style>
</head>
<body>
  <h2>User List</h2>
  <table id="userdata">
    <tr>
      <th>ID</th>
      <th>Department</th> 
      <th>Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Edit / Delete</th>
    </tr>
  </table>

  <script>
    // Fetch data from the server
    function fetchData() {
      fetch('data.php')
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
              <th>Edit / Delete</th>
            </tr>
          `;

          // Populate table with data
          data.forEach(userdata => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${userdata.id}</td>
              <td>${userdata.department}</td>
              <td>${userdata.name}</td>
              <td>${userdata.gender}</td>
              <td>${userdata.email}</td>
              <td>${userdata.phone}</td>
              <td class="actions">
                <button onclick="loginAndRedirect('edit', ${userdata.id})">Edit</button>
                <button onclick="loginAndRedirect('delete', ${userdata.id})">Delete</button>
              </td>
            `;
            table.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    // Redirect to login page with action and ID as query parameters
    function loginAndRedirect(action, id) {
      const redirectUrl = `security.php?action=${action}&id=${id}`;
      window.location.href = redirectUrl;
    }

    // Fetch initial data
    fetchData();
  </script>
</body>
</html>


 
