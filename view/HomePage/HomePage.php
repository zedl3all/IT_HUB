<?php
// HomePage.php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';


class HomePage {
    private User $user;
    private array $unjoinedCommunities = [];
    private array $joinedCommunities = [];

    // Getter และ Setter สำหรับ unjoinedCommunities
    public function getUnjoinedCommunities(): array {
        return $this->unjoinedCommunities;
    }

    public function setUnjoinedCommunities(array $unjoinedCommunities): void {
        $this->unjoinedCommunities = $unjoinedCommunities;
    }

    // Getter และ Setter สำหรับ joinedCommunities
    public function getJoinedCommunities(): array {
        return $this->joinedCommunities;
    }

    public function setJoinedCommunities(array $joinedCommunities): void {
        $this->joinedCommunities = $joinedCommunities;
    }

    // Getter และ Setter สำหรับ user
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    // ฟังก์ชันเรนเดอร์หน้าเว็บ
    public function render() {
        echo $this->getHead();
        echo $this->getHeader();
        echo $this->getContainer();
        echo $this->getCreatePopup();
        echo $this->getJoinPopup();
        echo $this->getRoleToggle();
        echo $this->getScripts();
    }

    // ส่วนของ head
    private function getHead(){
        return '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>&lt;i&gt; Hub</title>
            <link rel="stylesheet" href="/ISAD/view/HomePage/HomePage.css"> <!-- เปลี่ยนเป็น path ที่ถูกต้อง -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <style>
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    // ส่วนของ header
    private function getHeader() {
        return '
        <header>
            <div class="logo">
                <a href="HomePage.html">&lt;i&gt; Hub</a>
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search <i>Hub">
            </div>
            <div class="user-section">
                <div class="notification-bell">
                    <i class="fas fa-bell" id="bell-icon"></i>
                    <span class="notification-count" id="notification-count">1</span>
                </div>
                <div class="notification-icon"></div>
                <div class="profile-icon"></div>
            </div>
        </header>';
    }

    // ส่วนของ container หลัก
    private function getContainer() {
        return '
        <div class="container">
            <div class="left-sidebar">
                <nav>
                    <a href="HomePage.html" class="nav-item active"><i class="fas fa-home"></i> Home</a>
                    <a href="/ISAD/controller/AnnouncementController.php?Page=Anm" class="nav-item"><i class="fas fa-bullhorn"></i> Announcement</a>
                    <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
                </nav>
            </div>
            <main>
                <button class="create-community" onclick="openCreatePopup()">Create Community</button>
                ' . $this->getMyCommunitySection() . '
                ' . $this->getDiscoverCommunitySection() . '
            </main>
        </div>';
    }

    // ส่วนของ My Community
    private function getMyCommunitySection() {
        if (empty($this->joinedCommunities)) {
            return '<section>
                        <h2 style="border-bottom: 2px solid white; padding-bottom: 16px;">My Community</h2>
                        <p>No communities joined yet.</p>
                    </section>';
        }
        
        $cards = '';
        foreach ($this->joinedCommunities as $community) {
            $cards .= $this->renderCommunityCard(
                $community->getCommunityName(),
                $community->getAmoutOfMembers(),
                implode(' ', $community->getTag())
            );
        }
        
        return '
        <section>
            <h2 style="border-bottom: 2px solid white; padding-bottom: 16px;">My Community</h2>
            <div class="community-grid">
                ' . $cards . '
            </div>
        </section>';
    }

    // ส่วนของ Discover Community
    private function getDiscoverCommunitySection() {
        if (empty($this->unjoinedCommunities)) {
            return '<section>
                        <h2 style="border-top: 2px solid white; border-bottom: 2px solid white; margin-top: 16px; padding-top: 16px; padding-bottom: 16px;">Discover Community</h2>
                        <p>No communities to discover.</p>
                    </section>';
        }
    
        $cards = '';
        foreach ($this->unjoinedCommunities as $community) {
            $cards .= $this->renderDiscoverCommunityCard(
                $community->getCommunityName(),
                $community->getAmoutOfMembers(),
                implode(' ', $community->getTag())
            );
        }
    
        return '
        <section>
            <h2 style="border-top: 2px solid white; border-bottom: 2px solid white; margin-top: 16px; padding-top: 16px; padding-bottom: 16px;">Discover Community</h2>
            <div class="community-grid">
                ' . $cards . '
            </div>
        </section>';
    }

    // ฟังก์ชันสร้างการ์ดสำหรับ My Community
    private function renderCommunityCard($name, $members, $tags) {
        return '
        <div class="repeat-commu">
            <a href="../CommunityPage/CommunityPage.html">
                <div class="community-card">
                    <div class="community-image">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="community-info">' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</div>
                    <div class="community-info">' . htmlspecialchars($members, ENT_QUOTES, 'UTF-8') . '</div>
                    <div class="community-tags">' . htmlspecialchars($tags, ENT_QUOTES, 'UTF-8') . '</div>
                </div>
            </a>
        </div>';
    }

    // ฟังก์ชันสร้างการ์ดสำหรับ Discover Community
    private function renderDiscoverCommunityCard($name, $members, $tags) {
        return '
        <div class="repeat-discover_commu">
            <div class="community-card discover_commu">
                <div class="community-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="community-info">' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</div>
                <div class="community-info">' . htmlspecialchars($members, ENT_QUOTES, 'UTF-8') . '</div>
                <div class="community-tags">' . htmlspecialchars($tags, ENT_QUOTES, 'UTF-8') . '</div>
                <div class="locked-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>';
    }

    // ส่วนของ Create Popup
    private function getCreatePopup() {
        return '
        <div class="createPopup-overlay" id="createPopupOverlay">
            <div class="createPopup" id="createPopup">
                <span class="close" id="closeCreatePopup">&times;</span>
                <div class="createPopup-content">
                    <h2>Create Community</h2>
                    <p>Community name</p>
                    <input type="text" placeholder="Community name" id="communityNameInput">
                    <p>Enroll Key</p>
                    <input type="text" placeholder="Enroll Key" id="enrollKeyInput">
                    <p>Tags</p>
                    <div class="tag-container" id="tagContainer"></div>
                    <div class="tag-input-container">
                        <select id="tagSelect">
                            <option value="">Select Tag:</option>
                            <option value="Math">Math</option>
                            <option value="Problem Solving">Problem Solving</option>
                            <option value="Coding">Coding</option>
                            <option value="Information">Information</option>
                        </select>
                        <button id="addCustomTagBtn">+</button>
                    </div>
                    <input type="text" id="customTagInput" placeholder="Add custom tag" style="display: none;">
                    <p>Description</p>
                    <textarea placeholder="Description" id="descriptionInput" rows="4"></textarea>
                    <button onclick="CreateSubmit()">Create</button>
                </div>
            </div>
        </div>';
    }

    // ส่วนของ Join Popup
    private function getJoinPopup() {
        return '
        <div class="joinPopup-overlay" id="joinPopupOverlay">
            <div class="joinPopup" id="joinPopup">
                <span class="close" id="closeJoinPopup">&times;</span>
                <div class="joinPopup-content">
                    <p style="font-weight: bold; font-size: 24px; margin-bottom: 8px;">Community name 1/67</p>
                    <input type="text" placeholder="Enter your enroll key." id="enrollkeyInput"> <!-- แก้ type เป็น text -->
                    <button onclick="JoinSubmit()">Join</button>
                </div>
            </div>
        </div>';
    }

    // ส่วนของ Role Toggle
    private function getRoleToggle() {
        if(!isset($_SESSION["user_use_now"])){
            $role = "S";
        }else{
            $role = $_SESSION["user_use_now"]->getRole();
        }

        return '
            <div class="role-toggle">
                <form action = "/ISAD/controller/Join_Leave_Controller.php" method="GET">
                    <button class = "nick" name="role" value="1">Student</button>
                    <button class = "nick" name="role" value="2">Teacher</button>
                    <button class = "nick" name="role" value="3">TA</button>
                </form>
            </div>
            <script>
                var role = "'.$role.'";
                const createCommunityBtn = document.querySelector(".create-community");
                if (role == "T"){
                    createCommunityBtn.style.display = "inline-block";
                }else{
                    createCommunityBtn.style.display = "none";
                }
            </script>
            <style>
                .nick:hover{
                    background-color: #2757A1;
                    color: white;
                }</style>';  
    }

    // ส่วนของ Scripts
    private function getScripts() {
        return '<script src="/ISAD/view/HomePage/HomePage.js"></script>'; // เปลี่ยนเป็น path ที่ถูกต้อง
    }
}
// For testing
if ($_SESSION["user_use_now"]){
    echo $_SESSION["user_use_now"]->getFirstname();
    echo " Role: ";
    echo $_SESSION["user_use_now"]->getRole();
}
?>
