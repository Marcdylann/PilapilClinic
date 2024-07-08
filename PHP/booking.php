<?php
    if(isset($_POST['submit'])){
        include "connection.php";
        
        // Retrieving form data
        $firstname = $_POST['first-name'];
        $lastname = $_POST['last-name'];
        $MI = $_POST['middle-initial'];
        $birthdate = $_POST['birth-date'];
        $age = $_POST['age'];
        $religion = $_POST['religion'];
        $Mstatus = $_POST['marital-status'];
        $gender = $_POST['gender'];
        $Padd = $_POST['permanent-address'];
        $Cadd = $_POST['current-address'];
        $zipCode = $_POST['zip-code'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $department = $_POST['department'];
        $procedure = $_POST['procedure'];
        $appointment = $_POST['appointment-datetime'];

        // Insert into clientgeneralinformation
        $sql1 = "INSERT INTO clientgeneralinformation (FirstName, LastName, MiddleInitial, BirthDate, Age, Religion, MaritalStatus, Gender)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "ssssisss", $firstname, $lastname, $MI, $birthdate, $age, $religion, $Mstatus, $gender);
        $result1 = mysqli_stmt_execute($stmt1);

        // Insert into clientlocationdetails
        $sql2 = "INSERT INTO clientlocationdetails (PermanentAddress, CurrentAddress, ZipCode)
                 VALUES (?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "sss", $Padd, $Cadd, $zipCode);
        $result2 = mysqli_stmt_execute($stmt2);

        // Insert into clientsocials
        $sql3 = "INSERT INTO clientsocials (Email, PhoneNumber)
                 VALUES (?, ?)";
        $stmt3 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt3, "ss", $email, $phone);
        $result3 = mysqli_stmt_execute($stmt3);

        // Insert into clientappointmentdetails
        $sql4 = "INSERT INTO clientappointmentdetails (Department, DoctorsProcedure, AppointmentDateAndTime)
                 VALUES (?, ?, ?)";
        $stmt4 = mysqli_prepare($conn, $sql4);
        mysqli_stmt_bind_param($stmt4, "sss", $department, $procedure, $appointment);
        $result4 = mysqli_stmt_execute($stmt4);

        // Check if all queries were successful
        if ($result1 && $result2 && $result3 && $result4) {
            echo '<script>alert("Booking successful!");</script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the prepared statements
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
        mysqli_stmt_close($stmt4);
        
        // Close the connection
        mysqli_close($conn);
    }
?>