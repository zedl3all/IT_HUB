document.getElementById('closePopup').addEventListener('click', closePopup);
        document.getElementById('createPopupOverlay').addEventListener('click', function(event) {
            if (event.target === this) {
                closePopup();
            }
        });

function CreateSubmit() {
    const communityName = document.getElementById('communityNameInput').value;
    const enrollKey = document.getElementById('enrollKeyInput').value;
    const tags = document.getElementById('tagsInput').value;
    const description = document.getElementById('descriptionInput').value;
    
    console.log('Community Created:', {
        communityName,
        enrollKey,
        tags,
        description
    });
    
    closePopup();
}

// Function to open the create popup
function openCreatePopup() {
    document.getElementById('createPopupOverlay').style.display = 'block';
}

// Function to close the create popup
function closeCreatePopup() {
    document.getElementById('createPopupOverlay').style.display = 'none';
}

function closePopup() {
    document.getElementById('createPopupOverlay').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const popupOverlay = document.getElementById('joinPopupOverlay');
    const popup = document.getElementById('joinPopup');
    const closePopup = document.getElementById('closePopup');
    const enrollkeyInput = document.getElementById('enrollkeyInput');
    const communityCards = document.querySelectorAll('.discover_commu');

    // Function to open the popup
    function openPopup() {
        popupOverlay.style.display = 'block';
        document.getElementById('joinPopupOverlay').style.display = 'block';
    }

    // Event listeners
    communityCards.forEach(card => {
        card.addEventListener('click', openPopup); // Open popup when the card is clicked
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

// Function to close the join popup (defined globally)
function closePopupFunc() {
    const popupOverlay = document.getElementById('joinPopupOverlay');
    popupOverlay.style.display = 'none';
}

// Function to submit the join form
function JoinSubmit() {
    const enrollkeyInput = document.getElementById('enrollkeyInput');
    const enrollkey = enrollkeyInput.value;
    // Add your form submission logic here
    console.log(`Enroll key submitted: ${enrollkey}`);
    closePopupFunc(); // Close the popup after form submission
}
