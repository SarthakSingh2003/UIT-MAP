<!-- 3rd page -->
<?php
session_start();
if(!(isset($_SESSION['username']))){  //If the session variable is not set, then it means the user is not logged in and is accessing this page through url editing, as we have provided session username to every user who logged in. So, redirecting to login page
    header("location: index.php");
}
elseif($_SESSION['usertype']!="admin" && $_SESSION['usertype']!="student" && $_SESSION['usertype']!="mentor"){ //If the user is not admin, student, or mentor, then it means the user is accessing this page through url editing. So, redirecting to login page
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP - Rubrics Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body class="bg-gray-100 text-gray-800">

<?php include 'studentheaders.php' ?>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-4">
        <!-- Subheader -->
        <section class="mb-8">
            <center><h2 class="text-2xl font-bold mb-4">Rubrics Review</h2></center>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Review #</th>
                        <th class="border px-4 py-2">Agenda</th>
                        <th class="border px-4 py-2">Assessment</th>
                        <th class="border px-4 py-2">Last Date</th>
                        <th class="border px-4 py-2">Review Assessment Weightage</th>
                        <th class="border px-4 py-2">Overall Weightage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 1</td>
                        <td class="border px-4 py-2">Project Proposal Evaluation</td>
                        <td class="border px-4 py-2">Rubric R1</td>
                        <td class="border px-4 py-2">March 15, 2023</td>
                        <td class="border px-4 py-2">(18)</td>
                        <td class="border px-4 py-2" rowspan="3">50</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 2</td>
                        <td class="border px-4 py-2">Project Synopsis</td>
                        <td class="border px-4 py-2">Rubric R2</td>
                        <td class="border px-4 py-2">May 30, 2023</td>
                        <td class="border px-4 py-2">(24)</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 3</td>
                        <td class="border px-4 py-2">Evaluation by Supervisor</td>
                        <td class="border px-4 py-2">Rubric R3</td>
                        <td class="border px-4 py-2">July 25, 2023</td>
                        <td class="border px-4 py-2">(8)</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 4</td>
                        <td class="border px-4 py-2">7th Semester Project Evaluation</td>
                        <td class="border px-4 py-2">Rubric R4</td>
                        <td class="border px-4 py-2">August 30, 2023 *</td>
                        <td class="border px-4 py-2">(100)</td>
                        <td class="border px-4 py-2">100</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 5</td>
                        <td class="border px-4 py-2">8th Semester Project Evaluation</td>
                        <td class="border px-4 py-2">Rubric R5</td>
                        <td class="border px-4 py-2">November 15, 2023</td>
                        <td class="border px-4 py-2">(50(I)+100(E)=150)</td>
                        <td class="border px-4 py-2" rowspan="4">400</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 6</td>
                        <td class="border px-4 py-2">Project Report Evaluation</td>
                        <td class="border px-4 py-2">Rubric R6</td>
                        <td class="border px-4 py-2">December 30, 2023</td>
                        <td class="border px-4 py-2">(30(I)+60(E)=90)</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 7</td>
                        <td class="border px-4 py-2">Evaluation by Department Project Coordinator</td>
                        <td class="border px-4 py-2">Rubric R7</td>
                        <td class="border px-4 py-2">March 30, 2024</td>
                        <td class="border px-4 py-2">(20(I)+50(E)=70)</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">Review 8</td>
                        <td class="border px-4 py-2">Evaluation by Supervisor</td>
                        <td class="border px-4 py-2">Rubric R8</td>
                        <td class="border px-4 py-2">April 6, 2024</td>
                        <td class="border px-4 py-2">90</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 font-bold">Total</td>
                        <td class="border px-4 py-2 font-bold">550</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white p-4 text-center"">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-sm">&copy; 2024 College Name. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
