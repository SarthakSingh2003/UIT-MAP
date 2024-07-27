<?php
session_start();
if(!(isset($_SESSION['username']))){ 
    header("location: index.php");
}
elseif($_SESSION['usertype']!="admin" && $_SESSION['usertype']!="student" && $_SESSION['usertype']!="mentor"){
    header("location: index.php");
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mapdb';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT roll FROM info ORDER BY roll ASC";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row['roll'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP - Project Details</title>
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .locked {
            background-color: #f0f0f0;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

<?php include 'studentheaders.php' ?>

    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Student's Project Details</h2>

        <div class="mb-4">
            <label for="groupCode" class="block text-gray-700">Group Number:</label>
            <input type="text" id="groupCode" class="w-full border p-2" disabled>
        </div>

        <h3 class="text-xl font-bold mb-2">Project Group Details</h3>

        <div id="members" class="space-y-6"></div>

        <button id="addMemberBtn" class="bg-blue-500 text-white px-4 py-2 mt-4">Add Member</button>
    </div>

    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto" id="responsibilitiesSection" style="display:none;">
        <h2 class="text-2xl font-bold mb-4">Project Work Distribution</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Roll Number</th>
                    <th class="py-2">Name</th>
                    <th class="py-2">Section</th>
                    <th class="py-2">Branch</th>
                    <th class="py-2">Responsibility</th>
                </tr>
            </thead>
            <tbody id="responsibilitiesTable"></tbody>
        </table>
        <button id="saveDetailsBtn" class="bg-green-500 text-white px-4 py-2 mt-4">Save Details</button>
    </div>

    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Group Details</h2>

        <div class="mb-4">
            <label for="groupCreationDate" class="block text-gray-700">Group Creation Date:</label>
            <input type="date" id="groupCreationDate" class="w-full border p-2">
            <button id="lockGroupCreationDateBtn" class="bg-red-500 text-white px-4 py-2 mt-2">Lock</button>
        </div>

        <div class="mb-4">
            <label for="decApprovalStatus" class="block text-gray-700">DEC Approval Status:</label>
            <input type="text" id="decApprovalStatus" class="w-full border p-2" disabled>
        </div>

        <div class="mb-4" id="approvalDateDiv" style="display:none;">
            <label for="approvalDate" class="block text-gray-700">Approval Date:</label>
            <input type="date" id="approvalDate" class="w-full border p-2" disabled>
        </div>
    </div>

    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Project Information</h2>

        <div class="mb-4">
            <label for="projectTitle" class="block text-gray-700">Project Title:</label>
            <input type="text" id="projectTitle" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label for="briefIntroduction" class="block text-gray-700">Brief Introduction:</label>
            <textarea id="briefIntroduction" class="w-full border p-2 h-20"></textarea>
        </div>

        <div class="mb-4">
            <label for="objectiveStatement" class="block text-gray-700">Objective and Problem Statement:</label>
            <textarea id="objectiveStatement" class="w-full border p-2 h-20"></textarea>
        </div>

        <div class="mb-4">
            <label for="technologyUsed" class="block text-gray-700">Technology/Methodology Used:</label>
            <textarea id="technologyUsed" class="w-full border p-2 h-20"></textarea>
        </div>
    </div>

    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Approval Status</h2>

        <div class="mb-4">
            <label for="supervisorApprovalStatus" class="block text-gray-700">Supervisor Approval Status:</label>
            <input type="text" id="supervisorApprovalStatus" class="w-full border p-2" disabled>
        </div>

        <div class="mb-4" id="supervisorApprovalDateDiv" style="display:none;">
            <label for="supervisorApprovalDate" class="block text-gray-700">Supervisor Approval Date:</label>
            <input type="date" id="supervisorApprovalDate" class="w-full border p-2" disabled>
        </div>

        <div class="mb-4">
            <label for="decApprovalStatus" class="block text-gray-700">DEC Approval Status:</label>
            <input type="text" id="decApprovalStatus" class="w-full border p-2" disabled>
        </div>

        <div class="mb-4" id="decApprovalDateDiv" style="display:none;">
            <label for="decApprovalDate" class="block text-gray-700">DEC Approval Date:</label>
            <input type="date" id="decApprovalDate" class="w-full border p-2" disabled>
        </div>
    </div>

    <footer class="bg-blue-500 text-white p-4 mt-8">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; 2024 Your College Name. All rights reserved.</p>
        </div>
    </footer>

    <script>
    const members = [];
    const maxMembers = 4;
    const studentRolls = <?php echo json_encode($students); ?>;

    function memberTemplate(index) {
        return `
            <div class="member-form p-4 border ${members[index]?.locked ? 'locked' : ''}">
                <h4 class="text-lg font-bold">Project Member ${index + 1}</h4>
                <div class="mb-2">
                    <label class="block text-gray-700">Student Roll Number:</label>
                    <select class="w-full border p-2 roll-number" data-index="${index}">
                        <option value="">Select Roll number...</option>
                        ${studentRolls.map(roll => `<option value="${roll}" ${members[index]?.roll === roll ? 'selected' : ''}>${roll}</option>`).join('')}
                    </select>
                </div>
                <div class="details ${members[index]?.roll ? '' : 'hidden'}">
                    <div class="mb-2">
                        <label class="block text-gray-700">Name:</label>
                        <input type="text" class="w-full border p-2 name" ${members[index]?.locked ? 'disabled' : ''} value="${members[index]?.name || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700">Section:</label>
                        <input type="text" class="w-full border p-2 section" ${members[index]?.locked ? 'disabled' : ''} value="${members[index]?.section || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700">Branch:</label>
                        <input type="text" class="w-full border p-2 branch" ${members[index]?.locked ? 'disabled' : ''} value="${members[index]?.branch || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700">Responsibility:</label>
                        <input type="text" class="w-full border p-2 responsibility" ${members[index]?.locked ? 'disabled' : ''} value="${members[index]?.responsibility || ''}">
                    </div>
                </div>
                <button class="bg-red-500 text-white px-4 py-2 mt-2 lock-member" data-index="${index}">${members[index]?.locked ? 'Unlock' : 'Lock'} Member</button>
            </div>
        `;
    }

    function updateMembersUI() {
        const membersDiv = document.getElementById('members');
        membersDiv.innerHTML = '';
        members.forEach((member, index) => {
            membersDiv.innerHTML += memberTemplate(index);
        });
        addEventListeners();
    }

    function addEventListeners() {
        document.querySelectorAll('.roll-number').forEach(select => {
            select.addEventListener('change', (e) => {
                const index = e.target.dataset.index;
                const roll = e.target.value;
                if (roll) {
                    members[index].roll = roll;
                    members[index].name = '';  // Reset name, section, branch, responsibility
                    members[index].section = '';
                    members[index].branch = '';
                    members[index].responsibility = '';
                    e.target.closest('.member-form').querySelector('.details').classList.remove('hidden');
                } else {
                    members[index] = {};
                    e.target.closest('.member-form').querySelector('.details').classList.add('hidden');
                }
                updateMembersUI();
            });
        });

        document.querySelectorAll('.lock-member').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.dataset.index;
                members[index].locked = !members[index]?.locked;
                if (members[index].locked) {
                    members[index].name = e.target.closest('.member-form').querySelector('.name').value;
                    members[index].section = e.target.closest('.member-form').querySelector('.section').value;
                    members[index].branch = e.target.closest('.member-form').querySelector('.branch').value;
                    members[index].responsibility = e.target.closest('.member-form').querySelector('.responsibility').value;
                }
                updateMembersUI();
                updateResponsibilitiesTable();
                toggleResponsibilitiesSection();
            });
        });
    }

    function updateResponsibilitiesTable() {
        const tableBody = document.getElementById('responsibilitiesTable');
        tableBody.innerHTML = '';
        members.filter(member => member.locked).forEach(member => {
            tableBody.innerHTML += `
                <tr>
                    <td class="py-2">${member.roll}</td>
                    <td class="py-2">${member.name}</td>
                    <td class="py-2">${member.section}</td>
                    <td class="py-2">${member.branch}</td>
                    <td class="py-2">${member.responsibility}</td>
                </tr>
            `;
        });
    }

    function toggleResponsibilitiesSection() {
        const responsibilitiesSection = document.getElementById('responsibilitiesSection');
        if (members.some(member => member.locked)) {
            responsibilitiesSection.style.display = 'block';
        } else {
            responsibilitiesSection.style.display = 'none';
        }
    }

    document.getElementById('addMemberBtn').addEventListener('click', () => {
        if (members.length < maxMembers) {
            members.push({});
            updateMembersUI();
        }
    });

    document.getElementById('saveDetailsBtn').addEventListener('click', () => {
        // Save functionality can be implemented here
        alert('Details saved successfully!');
    });

    updateMembersUI();
    toggleResponsibilitiesSection();
    </script>
</body>
</html>
