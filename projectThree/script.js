// Simple Toast Function
function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Check for URL parameters to show success messages
window.onload = () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showToast('Operation successful!');
    } else if (urlParams.has('error')) {
        showToast('Something went wrong. Please try again.');
    } else if (urlParams.has('login_failed')) {
        showToast('Invalid credentials.');
    }
};
