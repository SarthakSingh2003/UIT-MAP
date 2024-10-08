<!-- Header --> 
<header class="bg-blue-600 text-white p-4">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <img src="COLLEGE.png" alt="College Logo" class="h-12">
        <h1 class="text-3xl font-bold">MAP - Student Panel</h1>
        
        <!-- Hamburger Icon -->
        <button id="menu-toggle" class="text-white focus:outline-none md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Full Menu -->
        <div id="menu" class="hidden md:flex space-x-4">
            <a href="studentdetails.php" class="text-lg">Student Details</a>
            <a href="guidelines.php" class="text-lg">Guidelines</a>
            <a href="details.php" class="text-lg">Group Details</a>
            <a href="status.php" class="text-lg">Weekly Analysis</a>
            <a href="rubrics.php" class="text-lg">Rubrics</a>
            <a href="logout.php" class="text-lg">Logout</a>
        </div>
    </div>
</header>

<!-- Sub-header for small screens -->
<nav id="mobile-menu" class="bg-blue-500 text-white hidden md:hidden">
    <div class="max-w-6xl mx-auto p-4 flex flex-col space-y-4">
        <a href="studentdetails.php" class="text-lg">Student Details</a>
        <a href="guidelines.php" class="text-lg">Guidelines</a>
        <a href="details.php" class="text-lg">Group Details</a>
        <a href="status.php" class="text-lg">Weekly Analysis</a>
        <a href="rubrics.php" class="text-lg">Rubrics</a>
        <a href="logout.php" class="text-lg">Logout</a>
    </div>
</nav>

<!-- JavaScript -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
