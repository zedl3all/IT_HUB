// ฟังก์ชันสำหรับเลือก Role
function selectRole(role) {
    const settingIconBtn = document.querySelector('.settings-icon');
    const deleteBtn = document.getElementById('deleteButton');

    // Reset active class สำหรับปุ่ม role ทั้งหมด
    document.querySelectorAll('.role-toggle button').forEach(btn => {
        btn.classList.remove('active');
    });

    // ตั้ง active class สำหรับปุ่มที่เลือก
    document.getElementById(role + 'Btn').classList.add('active');

    // แสดงปุ่ม "Create Community" เฉพาะ Teacher
    if (role === 'teacher') {
        settingIconBtn.style.display = 'inline-block';
        deleteBtn.style.display = 'inline-block';
    } 
    else if (role === 'ta'){
        settingIconBtn.style.display = 'inline-block';
        deleteBtn.style.display = 'none';
    }
    else {
        settingIconBtn.style.display = 'none';
    }
}

// ตั้ง Role เริ่มต้นเป็น Student
window.onload = function() {
    selectRole('student');
};

let originalData = {
    name: '',
    description: '',
    tags: []
};

function openEditPopup() {
    document.getElementById('editPopupOverlay').style.display = 'block';
    // Save original data
    originalData.name = document.getElementById('communityNameInput').value;
    originalData.description = document.getElementById('communityDescriptionInput').value;
    originalData.tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent.trim());
    checkFields();
}

function closeEditPopup() {
    document.getElementById('editPopupOverlay').style.display = 'none';
    // Clear input fields and tags when closing
    resetFields();
}

function addTag() {
    const newTagInput = document.getElementById('newTagInput');
    const tagName = newTagInput.value.trim();
    if (tagName) {
        const tagContainer = document.getElementById('tagContainer');
        const newTag = document.createElement('div');
        newTag.className = 'tag';
        newTag.innerHTML = `${tagName} <button class="remove-tag" onclick="removeTag(this)">×</button>`;
        tagContainer.appendChild(newTag);
        newTagInput.value = '';
        checkFields();
    }
}

function removeTag(button) {
    button.closest('.tag').remove();
    checkFields();
}

function checkFields() {
    const nameInput = document.getElementById('communityNameInput');
    const descriptionInput = document.getElementById('communityDescriptionInput');
    const currentTags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent.trim());
    
    const hasChanges = 
        nameInput.value !== originalData.name ||
        descriptionInput.value !== originalData.description ||
        JSON.stringify(currentTags) !== JSON.stringify(originalData.tags);

    document.getElementById('confirmButton').disabled = !hasChanges;
}

function confirmEdit() {
    const name = document.getElementById('communityNameInput').value;
    const description = document.getElementById('communityDescriptionInput').value;
    const tags = Array.from(document.querySelectorAll('.tag')).map(tag => tag.textContent.trim());
    console.log('Edited community:', { name, description, tags });
    
    // Clear the input fields and tags after confirmation
    resetFields();
    closeEditPopup();
}

function cancelEdit() {
    if (document.getElementById('confirmButton').disabled) {
        closeEditPopup();
    } else {
        if (confirm('Are you sure you want to cancel? Your changes will be lost.')) {
            // Clear the input fields and tags on cancel
            resetFields();
            closeEditPopup();
        }
    }
}

function deleteCommunity() {
    if (confirm('Are you sure you want to delete this community?')) {
        console.log('Community deleted');
        resetFields(); // Clear fields on deletion
        closeEditPopup();
    }
}

function resetFields() {
    document.getElementById('communityNameInput').value = '';
    document.getElementById('communityDescriptionInput').value = '';
    const tagContainer = document.getElementById('tagContainer');
    tagContainer.innerHTML = ''; // Clear all tags
}

document.getElementById('closePopup').addEventListener('click', cancelEdit);
document.getElementById('editPopupOverlay').addEventListener('click', function(event) {
    if (event.target === this) {
        cancelEdit();
    }
});

// Add event listeners to inputs for checking changes
document.getElementById('communityNameInput').addEventListener('input', checkFields);
document.getElementById('communityDescriptionInput').addEventListener('input', checkFields);
