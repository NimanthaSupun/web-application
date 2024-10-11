const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const themeToggler = document.querySelector(".theme-toggler");
const themeKey = "preferredTheme"; // Key for storing the theme in localStorage

// Event Listener for the handleResize function
window.addEventListener('resize', handleResize);

// Apply the preferred theme from localStorage on page load
applyPreferredTheme();

// Show sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

function closesidebar() {
    document.querySelector("aside").style.display = "none";
}

function handleResize() {
    // Get the current screen width
    var currentWidth = window.innerWidth;

    // Perform actions based on the screen width
    if (currentWidth <= 768) {
        document.querySelector("aside").style.display = "none";
    } else {
        document.querySelector("aside").style.display = "block";
    }
}

// Apply preferred theme
function applyPreferredTheme() {
    const preferredTheme = localStorage.getItem(themeKey);
    if (preferredTheme) {
        document.body.classList.add(preferredTheme);
    }
}

// Change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    // Check if dark theme is applied and store the preference
    if (document.body.classList.contains('dark-theme-variables')) {
        localStorage.setItem(themeKey, 'dark-theme-variables');
    } else {
        localStorage.removeItem(themeKey); // Remove theme preference if switching to light theme
    }

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})

// Preview image before uploading
function previewBeforeUpload(id) {
    document.querySelector("#" + id).addEventListener("change", function (e) {
        if (e.target.files.length == 0) {
            return;
        }
        let file = e.target.files[0];
        let url = URL.createObjectURL(file);
        document.querySelector("#" + id + "-preview div").innerText = file.name;
        document.querySelector("#" + id + "-preview img").src = url;
    });
}

previewBeforeUpload("file-1");
previewBeforeUpload("file-2");
previewBeforeUpload("file-3");
previewBeforeUpload("file-4");

