<?php
error_reporting(0); //To hide the errors
session_start(); //To start the session

$host="localhost";
$user="root";
$password="";
$db="mapdb";

$data=mysqli_connect($host,$user,$password,$db); //To connect with mysql db

if($data===false){
    die("ERROR in connection");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //Will only execute when someone clicks on login button of form
    //Getting the values from the form
    $username=$_POST['uniqueId']; 
    $password=$_POST['password'];
    
    $sql="SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result=mysqli_query($data,$sql); 
    //Through $data parameter, the function knows which database connection to use when executing the query and through $sql parameter, the function knows which query to execute. And mysqli_query() function returns the whole result set of all those rows(users) which satisfy the condition in sql query. But this result set will only contain single row as the username is unique. 
    
    //And this fetched result set can't be used directly. So, we need to fetch the data from the result set using mysqli_fetch_array() function which will fetch the first row of result set. 
    $row=mysqli_fetch_array($result); 

    if($row["usertype"]=="admin"){ 
        $_SESSION['username']=$username; //Storing the username in session variable whenever the correct username and password is entered so that when we check those session variables in adminhome.php, we can know that the user is logged in and is not accessing through URL editing. 
        $_SESSION['usertype']="admin"; //Storing the usertype in session variable so that we can know that the user is admin
        header("location: adminhome.php"); //If the user is admin redirecting to adminhome.php
    }
    else if($row["usertype"]=="student"){ 
        $_SESSION['username']=$username; //Storing the username in session variable whenever the correct username and password is entered so that when we check those session variables in studentdetails.php, we can know that the user is logged in and is not accessing through URL editing.
        $_SESSION['usertype']="student"; //Storing the usertype in session variable so that we can know that the user is student
        header("location: studentdetails.php"); //If the user is student redirecting to studentdetails.php
    }
    else if($row["usertype"]=="mentor"){ 
        $_SESSION['username']=$username; //Storing the username in session variable whenever the correct username and password is entered so that when we check those session variables in mentorhome.php, we can know that the user is logged in.
        $_SESSION['usertype']="mentor"; //Storing the usertype in session variable so that we can know that the user is student
        header("location: mentorhome.php"); //If the user is mentor redirecting to 1st.html
    }
    else{
        $message= "Invalid username or password"; //If the username or password is incorrect
        $_SESSION['loginMessage']=$message; //Storing the error message in session variable
        header("location: index.php"); //Redirecting to login page
    }
}
?>
