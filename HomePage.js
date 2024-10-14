document.addEventListener('DOMContentLoaded', function () {
    const popupOverlay = document.getElementById('popupOverlay');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('closePopup');
    const enrollkeyInput = document.getElementById('enrollkeyInput');
    const communityCards = document.querySelectorAll('.discover_commu');

    // Function to open the popup
    function openPopup() {
        popupOverlay.style.display = 'block';
    }

    // Event listeners
    communityCards.forEach(card => {
        card.addEventListener('click', openPopup); // เปิด popup เมื่อกดการ์ด
    });
    // Close the popup when the close button is clicked
    closePopup.addEventListener('click', closePopupFunc);
    // Close the popup when clicking outside the popup content
    popupOverlay.addEventListener('click', function (event) {
        if (event.target === popupOverlay) {
            closePopupFunc();
        }
    });
});

// Function to submit the signup form
function submitForm() {
    const enrollkey = enrollkeyInput.value;
    // Add your form submission logic here
    console.log(`enroll key Submitted ${enrollkey}`);
    closePopupFunc();
}

// Function to close the popup
function closePopupFunc() {
    popupOverlay.style.display = 'none';
}