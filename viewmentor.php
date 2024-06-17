<?php
session_start();
if(!(isset($_SESSION['username']))){  //If the session variable is not set, then it means the user is not logged in and is accessing this page through url editing, as we have provided session username to every user who logged in. So, redirecting to login page
    header("location: index.php");
}
elseif($_SESSION['usertype']!="admin"){ //If the user is not admin, then it means the user is student and is accessing this page through url editing as we have provided admin usertype to every user who logged in via admin credentials. So, redirecting to login page
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP - View Mentors</title>
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <img src="COLLEGE.png" alt="College Logo" class="h-12">
            <h1 class="text-3xl font-bold">MAP - Admin Panel</h1>
            <div></div>
        </div>
    </header>

    <!-- Sub-header -->
    <nav class="bg-blue-500 text-white">
        <div class="max-w-6xl mx-auto p-4 flex flex-wrap justify-between">
            <a href="addstudent.php" class="text-lg">Add Student</a>
            <a href="viewstudent.php" class="text-lg">View Students</a>
            <a href="addmentor.php" class="text-lg">Add Mentor</a>
            <a href="viewmentor.php" class="text-lg font-bold underline">View Mentors</a>
            <a href="adminguidelines.php" class="text-lg">Guidelines</a>
            <a href="logout.php" class="text-lg">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-100 p-8">
        <div class="max-w-6xl mx-auto">
            <center><h2 class="text-2xl font-bold mb-6">View Mentors</h2></center>

            <!-- Search Box -->
            <div class="mb-6">
                <input type="text" id="searchInput" placeholder="Search for mentors by name..." class="w-full p-2 border rounded">
            </div>

            <!-- Mentor List -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <ul>
                    <!-- Sample mentor items. Replace with actual mentor data. -->
                    <li class="mentor-item mb-2">
                        <span class="mentor-name">Dr. John Doe</span> - <span class="mentor-email">johndoe@example.com</span>
                    </li>
                    <li class="mentor-item mb-2">
                        <span class="mentor-name">Dr. Jane Smith</span> - <span class="mentor-email">janesmith@example.com</span>
                    </li>
                    <!-- Add more mentor items as needed -->
                </ul>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white p-4 mt-8">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; 2024 Your College Name. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>