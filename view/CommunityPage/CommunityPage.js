// ฟังก์ชันสำหรับเลือก Role
function selectRole(role) {
    const settingIconBtn = document.querySelector('.settings-icon');
    const deleteBtn = document.getElementById('deleteButton');
    const editPopup = document.getElementById('editPopup');
    const announcementBtn = document.querySelector('.announcement-btn');
    const postTypeSelect = document.getElementById('postTypeSelect');

    // Reset active class for all role buttons
    document.querySelectorAll('.role-toggle button').forEach(btn => {
        btn.classList.remove('active');
    });

    // Set active class for selected button
    document.getElementById(role + 'Btn').classList.add('active');

    if (role === 'teacher') {
        settingIconBtn.style.display = 'inline-block';
        deleteBtn.style.display = 'inline-block';
        announcementBtn.style.display = 'inline-block';
        updatePostTypeOptions(['Announcement', 'Question', 'Poll']);
    } 
    else if (role === 'ta') {
        settingIconBtn.style.display = 'inline-block';
        deleteBtn.style.display = 'none';
        announcementBtn.style.display = 'inline-block';
        updatePostTypeOptions(['Announcement', 'Question', 'Poll']);
    }
    else {
        settingIconBtn.style.display = 'none';
        announcementBtn.style.display = 'none';
        updatePostTypeOptions(['Question', 'Poll']);
    }
}

function updatePostTypeOptions(options) {
    const postTypeSelect = document.getElementById('postTypeSelect');
    
    postTypeSelect.innerHTML = '';
    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option.toLowerCase();
        optionElement.textContent = option;
        postTypeSelect.appendChild(optionElement);
    });
}

function expandPostCreator(postType) {
    const postCreator = document.querySelector('.post-creator');
    const expandedPostCreator = document.querySelector('.expanded-post-creator');
    const postTypeSelect = document.getElementById('postTypeSelect');

    postCreator.style.display = 'none';
    expandedPostCreator.style.display = 'block';

    if (typeof postType === 'string') {
        postTypeSelect.value = postType.toLowerCase();
    } else {
        // Set to the default value if postType is not a string
        postTypeSelect.value = postTypeSelect.options[0].value;
    }

    // Add event listener for clicking outside
    document.addEventListener('click', handleClickOutside);
}

function collapsePostCreator() {
    const postCreator = document.querySelector('.post-creator');
    const expandedPostCreator = document.querySelector('.expanded-post-creator');

    postCreator.style.display = 'block';
    expandedPostCreator.style.display = 'none';

    // Remove event listener for clicking outside
    document.removeEventListener('click', handleClickOutside);
}

function resetPostCreatorFields() {
    document.querySelector('.post-topic').value = '';
    document.querySelector('.post-details').value = '';
    document.getElementById('selectedTags').innerHTML = '';
}

function handleClickOutside(event) {
    const expandedPostCreator = document.querySelector('.expanded-post-creator');
    const postInput = document.querySelector('.post-input');
    const postTypeButtons = document.querySelectorAll('.post-type-btn');
    const postTypeSelect = document.getElementById('postTypeSelect');

    if (!expandedPostCreator.contains(event.target) && 
        event.target !== postInput &&
        !Array.from(postTypeButtons).includes(event.target) &&
        event.target !== postTypeSelect) {
        collapsePostCreator();
        resetPostCreatorFields();
    }
}

// ตั้ง Role เริ่มต้นเป็น Student
window.onload = function() {
    selectRole('student');
};

document.addEventListener('DOMContentLoaded', function() {
    const postCreator = document.querySelector('.post-creator');
    const expandedPostCreator = document.querySelector('.expanded-post-creator');
    const postInput = document.querySelector('.post-input');
    const postTypeButton = document.getElementById('post-type-announcement');
    const postType = document.querySelector('.post-type');
    const closeButton = document.querySelector('.close-button');
    const tagSelect = document.getElementById('tagSelect');
    const selectedTags = document.getElementById('selectedTags');
    const addCustomTagBtn = document.getElementById('addCustomTagBtn');
    const customTagInput = document.getElementById('customTagInput');
  
    postInput.addEventListener('click', expandPostCreator);
    closeButton.addEventListener('click', collapsePostCreator);
  
    postTypeButton.addEventListener('click', function() {
        expandPostCreator();
      });
  
    // Sample tags - replace with your actual tags
    const initialTags = ['code', 'importants', 'exam', 'project'];
    initialTags.forEach(tag => addOption(tag));

    tagSelect.addEventListener('change', function() {
        if (this.value) {
            addTag(this.value);
            removeOption(this.value);
            this.value = '';
        }
    });

    addCustomTagBtn.addEventListener('click', function() {
        customTagInput.style.display = customTagInput.style.display === 'none' ? 'inline-block' : 'none';
    });

    customTagInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            addTag(this.value.trim());
            this.value = '';
            this.style.display = 'none';
        }
    });

    function addTag(tagText) {
        const tag = document.createElement('div');
        tag.className = 'tag';
        tag.innerHTML = `${tagText} <button onclick="removeTag(this)">×</button>`;
        selectedTags.appendChild(tag);
    }

    function removeTag(button) {
        const tag = button.parentElement;
        const tagText = tag.textContent.trim().slice(0, -1); // ลบตัวอักษร '×'
        addOption(tagText);
        tag.remove();
    }

    function removeOption(value) {
        const option = tagSelect.querySelector(`option[value="${value}"]`);
        if (option) option.remove();
    }

    function addOption(value) {
        if (!tagSelect.querySelector(`option[value="${value}"]`)) {
            const option = document.createElement('option');
            option.value = option.textContent = value;
            tagSelect.appendChild(option);
        }
    }

    // เพิ่มฟังก์ชัน removeTag ให้กับ window object เพื่อให้สามารถเรียกใช้จาก onclick ได้
    window.removeTag = removeTag;
  });

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
