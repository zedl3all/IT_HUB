// ฟังก์ชันสำหรับเลือก Role
function selectRole(role) {
    const createCommunityBtn = document.querySelector('.create-community');

    // Reset active class สำหรับปุ่ม role ทั้งหมด
    document.querySelectorAll('.role-toggle button').forEach(btn => {
        btn.classList.remove('active');
    });

    // ตั้ง active class สำหรับปุ่มที่เลือก
    document.getElementById(role + 'Btn').classList.add('active');

    // แสดงปุ่ม "Create Community" เฉพาะ Teacher
    if (role === 'teacher') {
        createCommunityBtn.style.display = 'inline-block';
    } else {
        createCommunityBtn.style.display = 'none';
    }
}

// ตั้ง Role เริ่มต้นเป็น Student
window.onload = function() {
    selectRole('student');
};

//Create Community Popup
document.getElementById('closeCreatePopup').addEventListener('click', closeCreatePopup);
document.getElementById('createPopupOverlay').addEventListener('click', function(event) {
    if (event.target === this) {
        closeCreatePopup();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const closeCreatePopup = document.getElementById('closeCreatePopup');
    const createPopupOverlay = document.getElementById('createPopupOverlay');
    const tagSelect = document.getElementById('tagSelect');
    const addCustomTagBtn = document.getElementById('addCustomTagBtn');
    const customTagInput = document.getElementById('customTagInput');
    const tagContainer = document.getElementById('tagContainer');

    createPopupOverlay.addEventListener('click', function(event) {
        if (event.target === this) {
            closeCreatePopup();
        }
    });

    tagSelect.addEventListener('change', function() {
        if (this.value) {
            addTag(this.value);
            removeOption(this.value);
            this.value = '';
        }
    });

    addCustomTagBtn.addEventListener('click', function() {
        customTagInput.style.display = customTagInput.style.display === 'none' ? 'block' : 'none';
    });

    customTagInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            addTag(this.value);
            this.value = '';
            this.style.display = 'none';
        }
    });

    function addTag(tagText) {
        const tag = document.createElement('div');
        tag.className = 'tag';
        tag.innerHTML = `
            ${tagText}
            <span class="tag-close">&times;</span>
        `;
        tag.querySelector('.tag-close').addEventListener('click', function() {
            tagContainer.removeChild(tag);
            addOption(tagText);
        });
        tagContainer.appendChild(tag);
    }

    function removeOption(value) {
        const option = tagSelect.querySelector(`option[value="${value}"]`);
        if (option) {
            option.remove();
        }
    }

    function addOption(value) {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        tagSelect.appendChild(option);
    }
});

function CreateSubmit() {
    const communityName = document.getElementById('communityNameInput').value;
    const enrollKey = document.getElementById('enrollKeyInput').value;
    const tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent.trim());
    const description = document.getElementById('descriptionInput').value;

    console.log('Community Created:', {
        communityName,
        enrollKey,
        tags,
        description
    });

    // Clear input fields after submission
    clearCreateForm();

    closeCreatePopup();
}

function clearCreateForm() {
    document.getElementById('communityNameInput').value = '';
    document.getElementById('enrollKeyInput').value = '';
    document.getElementById('descriptionInput').value = '';

    // Clear all tags and restore options
    const tagContainer = document.getElementById('tagContainer');
    const tagSelect = document.getElementById('tagSelect');
    
    // Restore all options
    const defaultOptions = ['Math', 'Problem Solving', 'Coding', 'Information'];
    tagSelect.innerHTML = '<option value="">Select Tag:</option>';
    defaultOptions.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option;
        optionElement.textContent = option;
        tagSelect.appendChild(optionElement);
    });

    // Clear tags
    tagContainer.innerHTML = '';
}

function openCreatePopup() {
    document.getElementById('createPopupOverlay').style.display = 'block';
}

function closeCreatePopup() {
    clearCreateForm();
    document.getElementById('createPopupOverlay').style.display = 'none';
}

// Join Community Popup
document.getElementById('closeJoinPopup').addEventListener('click', closePopupFunc);
document.getElementById('createPopupOverlay').addEventListener('click', function(event) {
    if (event.target === this) {
        closeCreatePopup();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const popupOverlay = document.getElementById('joinPopupOverlay');
    const popup = document.getElementById('joinPopup');
    const closePopup = document.getElementById('closePopup');
    const enrollkeyInput = document.getElementById('enrollkeyInput');
    const communityCards = document.querySelectorAll('.discover_commu');

    function openPopup() {
        popupOverlay.style.display = 'block';
        document.getElementById('joinPopupOverlay').style.display = 'block';
    }

    communityCards.forEach(card => {
        card.addEventListener('click', openPopup);
    });

    popupOverlay.addEventListener('click', function (event) {
        if (event.target === popupOverlay) {
            closePopupFunc();
        }
    });
});

function closePopupFunc() {
    const popupOverlay = document.getElementById('joinPopupOverlay');
    popupOverlay.style.display = 'none';
    document.getElementById('enrollkeyInput').value = '';
}

function JoinSubmit() {
    const enrollkeyInput = document.getElementById('enrollkeyInput');
    const enrollkey = enrollkeyInput.value;

    console.log(`Enroll key submitted: ${enrollkey}`);

    enrollkeyInput.value = '';

    closePopupFunc();
}