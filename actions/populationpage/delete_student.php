<?php
if (isset($_POST['delete'])) {
    require_once '../../connectionquery/db_connection.php';

    // Call the db_connect function to get the database connection object
    $conn = db_connect();


    // Use proper escaping or prepared statements to prevent SQL injection
    $STUDENT_EPITA_EMAIL = $conn->real_escape_string($_GET['email']);

    //Deleting all existing data related to the student.
    $sql = "DELETE c, s, a, g
    FROM CONTACTS c
    INNER JOIN STUDENTS s ON c.CONTACT_EMAIL = s.STUDENT_CONTACT_REF
    INNER JOIN GRADES g ON s.STUDENT_EPITA_EMAIL = g.GRADE_STUDENT_EPITA_EMAIL_REF
    left JOIN ATTENDANCE a ON s.STUDENT_EPITA_EMAIL = a.ATTENDANCE_STUDENT_REF
    WHERE s.STUDENT_EPITA_EMAIL = '".$STUDENT_EPITA_EMAIL."'";

    if ($conn->query($sql) === TRUE) {
        header("Location: " .  $_SERVER['HTTP_REFERER']);
        exit;
      
    } else {
        echo "Connection error";
    }

    $conn->close();
}
?>
