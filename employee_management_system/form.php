<?php
include("connection.php");

if(isset($_POST['searchdata'])){
   $search = $_POST['search'];

   // Properly execute the query and fetch the result
   if (!empty($search)) {
       $query = "SELECT * FROM form WHERE id = '$search'";
       $data = mysqli_query($conn, $query); // Execute the query
       if($data){
           $result = mysqli_fetch_assoc($data); // Fetch the result as an associative array
       }else{
           echo "<script>alert('Query failed: " . mysqli_error($conn) . "');</script>";
       }
   } else {
       // Handle case where search field is empty (optional)
       // You can set default behavior or display a message
       echo "<script>alert('Please enter an ID to search.');</script>";
   }
}

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "INSERT INTO form (emp_name, emp_gender, emp_email, emp_department, emp_address) VALUES ('$name', '$gender', '$email', '$department', '$address')";

    $data = mysqli_query($conn, $query);

    if($data){
        echo "<script> alert('Data saved into Database'); </script>";
    }else{
        echo "<script> alert('Failed to save data'); </script>";
    }
}

if(isset($_POST['delete'])){
    $id = $_POST['search'];

    $query = "DELETE FROM form WHERE id = '$id'";
    $data = mysqli_query($conn, $query);

    if($data){
        echo "<script> alert('Record deleted'); </script>";
    }else{
        echo "<script> alert('Failed to delete the record'); </script>";
    }
}

if(isset($_POST['update'])){
    $id = $_POST['search'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "UPDATE form SET emp_name = '$name', emp_gender = '$gender', emp_email = '$email', emp_department = '$department', emp_address = '$address' WHERE id = '$id'" ;

    $data = mysqli_query($conn, $query);

    if($data){
        // Check if the update was successful and show alert only then
        if(mysqli_affected_rows($conn) > 0) {
            echo "<script> alert('Data Updated'); </script>";
        }
    }else{
        echo "<script> alert('Failed to update data'); </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Development</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="center">
        <form id="myForm" action="#" method="POST" onsubmit="return validateForm()">
            <h1>Employee Data Entry Automation Software</h1>
            <div class="form">
                <input id="searchbar" type="text" name="search" class="textfield" placeholder="Search ID"
                    value="<?php if(isset($result['id'])){echo $result['id'];} ?>" >
                <input id="name" type="text" name="name" class="textfield" placeholder="Employee Name"
                    value="<?php if(isset($result['emp_name'])){echo $result['emp_name'];} ?>">

                <select class="textfield" name="gender">
                    <option value="Not Selected">Select Gender</option>
                    <option value="Male" <?php if(isset($result['emp_gender']) && $result['emp_gender'] == 'Male'){echo "selected";} ?>>Male</option>
                    <option value="Female" <?php if(isset($result['emp_gender']) && $result['emp_gender'] == 'Female'){echo "selected";} ?>>Female</option>
                    <option value="Other" <?php if(isset($result['emp_gender']) && $result['emp_gender'] == 'Other'){echo "selected";} ?>>Other</option>
                </select>

                <input id="email" type="text" name="email" class="textfield" placeholder="Email Address"
                    value="<?php if(isset($result['emp_email'])){echo $result['emp_email'];} ?>">

                <select class="textfield" name="department">
                    <option value="Not Selected">Select Department</option>
                    <option value="IT" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'IT'){echo "selected";} ?>>IT</option>
                    <option value="Accountant" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'Accountant'){echo "selected";} ?>>Accountant</option>
                    <option value="Sales" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'Sales'){echo "selected";} ?>>Sales</option>
                    <option value="HR" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'HR'){echo "selected";} ?>>HR</option>
                    <option value="Business Development" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'Business Development'){echo "selected";} ?>>Business Development</option>
                    <option value="Marketing" <?php if(isset($result['emp_department']) && $result['emp_department'] == 'Marketing'){echo "selected";} ?>>Marketing</option>
                </select>

                <textarea placeholder="Address" name="address"><?php if(isset($result['emp_address'])){echo $result['emp_address'];} ?></textarea>

                <input type="submit" value="Search" name="searchdata" class="btn" style="background-color:grey;">
                <input type="submit" name="save" value="Save" class="btn3" style="background-color:green;">
                <input type="submit" value="Update" name="update" class="btn1" style="background-color:yellow;">
                <input type="button" value="Delete" name="delete" class="btn4" style="background-color:red;" onclick="confirmDelete()">
                <input type="submit" value="Clear" name="" class="btn2" style="background-color:blue;">
            </div>
        </form>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this record ?')) {
                // Set a hidden input field to submit the form for deletion
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete';
                input.value = 'delete';
                document.getElementById('myForm').appendChild(input);
                document.getElementById('myForm').submit();
            }
        }

    function validateForm() {
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();

        // Allow submission for search button without validation
        if (document.activeElement && document.activeElement.name === 'searchdata') {
            return true;
        }

        if (name === '') {
            alert('Please enter a name.');
            return false;
        }

        if (email === '') {
            alert('Please enter an email address.');
            return false;
        }

        // Validate email format using regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        return true;
    }


    </script>
</body>
</html>

