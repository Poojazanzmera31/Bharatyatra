function toggleDropdown() {
    const dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
}
function toggleDropdown1() {
    const dropdownContent = document.querySelector('.dropdown-content1');
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
}
function hideAllSections() {
    document.getElementById('dashboardsection').style.display = 'none';
    document.getElementById('formContainer').style.display = 'none';
    document.getElementById('formcontent').style.display = 'none';
    document.getElementById('displaySection').style.display = 'none';
    document.getElementById('displaycontent').style.display = 'none';
    document.getElementById('displayusers').style.display = 'none';
    document.getElementById('displaybookings').style.display = 'none';
    document.getElementById('displayinquiry').style.display = 'none';
    document.getElementById('displayreviews').style.display = 'none';
}

function showdashboard() {
    hideAllSections();
    document.getElementById('dashboardsection').style.display = 'block';
}

function showCreateForm() {
    hideAllSections();
    document.getElementById('formContainer').style.display = 'block';
}

function showformcontent() {
    hideAllSections();
    document.getElementById('formcontent').style.display = 'block';
}

function showDisplaySection() {
    hideAllSections();
    document.getElementById('displaySection').style.display = 'block';
}

function showDisplaycontent() {
    hideAllSections();
    document.getElementById('displaycontent').style.display = 'block';
}

function showDisplayUsers() {
    hideAllSections();
    document.getElementById('displayusers').style.display = 'block';
}

function showBookings() {
    hideAllSections();
    document.getElementById('displaybookings').style.display = 'block';
}

function showInquries() {
    hideAllSections();
    document.getElementById('displayinquiry').style.display = 'block';
}
function showReviews() {
    hideAllSections();
    document.getElementById('displayreviews').style.display = 'block';
}
function showSection(sectionId) {
    // Hide all sections
    var sections = document.querySelectorAll('main section');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Show the selected section
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}