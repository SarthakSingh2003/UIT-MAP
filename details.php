<!-- 4th page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP - Project Details</title>
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

<?php include 'studentheaders.php' ?>

    <!-- Main Content -->
    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Student's Project Details</h2>

        <div class="mb-4">
            <label for="groupCode" class="block text-gray-700">Group Number:</label>
            <input type="text" id="groupCode" class="w-full border p-2" disabled>
        </div>

        <h3 class="text-xl font-bold mb-2">Project Group Details</h3>

        <div id="members" class="space-y-6">
            <!-- Member forms will be dynamically added here -->
        </div>

        <button id="addMemberBtn" class="bg-blue-500 text-white px-4 py-2 mt-4">Add Member</button>
    </div>

    <!-- Responsibilities Section -->
    <div class="w-full bg-white p-8 shadow-lg my-8 mx-auto" id="responsibilitiesSection" style="display:none;">
        <h2 class="text-2xl font-bold mb-4">Project Work Distribution</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Project Member Name</th>
                    <th class="py-2">Responsibility</th>
                </tr>
            </thead>
            <tbody id="responsibilitiesTable">
                <!-- Responsibilities rows will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <!-- Group Details Section -->
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

    <!-- Project Information Section -->
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

    <!-- Approval Section -->
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

    <!-- Footer -->
    <footer class="bg-blue-500 text-white p-4 mt-8">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; 2024 Your College Name. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const members = [];
        const maxMembers = 4;

        const memberTemplate = (index) => `
            <div class="member-form p-4 border ${members[index]?.locked ? 'locked' : ''}">
                <h4 class="text-lg font-bold">Project Member ${index + 1}</h4>
                <div class="mb-2">
                    <label class="block text-gray-700">Student Name:</label>
                    <input type="text" class="w-full border p-2" value="${members[index]?.name || ''}" ${members[index]?.locked ? 'disabled' : ''}>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700">Roll Number:</label>
                    <input type="text" class="w-full border p-2" value="${members[index]?.roll || ''}" ${members[index]?.locked ? 'disabled' : ''}>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700">Branch:</label>
                    <input type="text" class="w-full border p-2" value="${members[index]?.branch || 'Computer Science'}" ${members[index]?.locked ? 'disabled' : ''}>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700">Section:</label>
                    <input type="text" class="w-full border p-2" value="${members[index]?.section || ''}" ${members[index]?.locked ? 'disabled' : ''}>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700">Signature of student:</label>
                    <input type="file" class="w-full border p-2" ${members[index]?.locked ? 'disabled' : ''}>
                </div>
                <button class="lockMemberBtn bg-red-500 text-white px-4 py-2 mt-2" ${members[index]?.locked ? 'disabled' : ''}>Lock</button>
            </div>
        `;

        const responsibilityTemplate = (member) => `
            <tr>
                <td class="border px-4 py-2">${member.name}</td>
                <td class="border px-4 py-2"><input type="text" class="w-full border p-2"></td>
            </tr>
        `;

        function renderMembers() {
            const membersDiv = document.getElementById('members');
            membersDiv.innerHTML = members.map((_, i) => memberTemplate(i)).join('');
        }

        function renderResponsibilities() {
            const responsibilitiesTable = document.getElementById('responsibilitiesTable');
            responsibilitiesTable.innerHTML = members.filter(member => member.locked).map(responsibilityTemplate).join('');
        }

        function lockMember(index) {
            const memberForm = document.querySelectorAll('.member-form')[index];
            const inputs = memberForm.querySelectorAll('input[type=text]');
            const fileInput = memberForm.querySelector('input[type=file]');
            members[index] = {
                name: inputs[0].value,
                roll: inputs[1].value,
                branch: inputs[2].value,
                section: inputs[3].value,
                signature: fileInput.files[0],
                locked: true
            };
            renderMembers();
            if (members.filter(member => member.locked).length > 0) {
                document.getElementById('responsibilitiesSection').style.display = 'block';
                renderResponsibilities();
            }
        }

        document.getElementById('addMemberBtn').addEventListener('click', () => {
            if (members.length < maxMembers) {
                members.push({});
                renderMembers();
            } else {
                alert('Maximum 4 members allowed');
            }
        });

        document.getElementById('members').addEventListener('click', (e) => {
            if (e.target.classList.contains('lockMemberBtn')) {
                const index = Array.from(document.querySelectorAll('.lockMemberBtn')).indexOf(e.target);
                lockMember(index);
            }
        });

        document.getElementById('lockGroupCreationDateBtn').addEventListener('click', () => {
            const groupCreationDateInput = document.getElementById('groupCreationDate');
            groupCreationDateInput.disabled = true;
            document.getElementById('lockGroupCreationDateBtn').disabled = true;
        });

        function fetchDecApprovalStatus() {
            // Mocking the DEC approval data fetch
            const decApprovalData = {
                approved: true,
                approvalDate: '2024-01-15'
            };

            const decApprovalStatusInput = document.getElementById('decApprovalStatus');
            const approvalDateDiv = document.getElementById('approvalDateDiv');
            const approvalDateInput = document.getElementById('approvalDate');

            if (decApprovalData.approved) {
                decApprovalStatusInput.value = 'Approved';
                approvalDateInput.value = decApprovalData.approvalDate;
                approvalDateDiv.style.display = 'block';
            } else {
                decApprovalStatusInput.value = 'Not Approved';
                approvalDateDiv.style.display = 'none';
            }
        }

        // Initial render
        renderMembers();
        fetchDecApprovalStatus();

        function fetchSupervisorApprovalStatus() {
            // Mocking the supervisor approval data fetch
            const supervisorApprovalData = {
                approved: true,
                approvalDate: '2024-01-10'
            };

            const supervisorApprovalStatusInput = document.getElementById('supervisorApprovalStatus');
            const supervisorApprovalDateDiv = document.getElementById('supervisorApprovalDateDiv');
            const supervisorApprovalDateInput = document.getElementById('supervisorApprovalDate');

            if (supervisorApprovalData.approved) {
                supervisorApprovalStatusInput.value = 'Approved';
                supervisorApprovalDateInput.value = supervisorApprovalData.approvalDate;
                supervisorApprovalDateDiv.style.display = 'block';
            } else {
                supervisorApprovalStatusInput.value = 'Not Approved';
                supervisorApprovalDateDiv.style.display = 'none';
            }
        }

        function fetchDecApprovalStatus() {
            // Mocking the DEC approval data fetch
            const decApprovalData = {
                approved: true,
                approvalDate: '2024-01-15'
            };

            const decApprovalStatusInput = document.getElementById('decApprovalStatus');
            const decApprovalDateDiv = document.getElementById('decApprovalDateDiv');
            const decApprovalDateInput = document.getElementById('decApprovalDate');

            if (decApprovalData.approved) {
                decApprovalStatusInput.value = 'Approved';
                decApprovalDateInput.value = decApprovalData.approvalDate;
                decApprovalDateDiv.style.display = 'block';
            } else {
                decApprovalStatusInput.value = 'Not Approved';
                decApprovalDateDiv.style.display = 'none';
            }
        }

        // Initial fetch
        fetchSupervisorApprovalStatus();
        fetchDecApprovalStatus();
    </script>
</body>
</html>
k