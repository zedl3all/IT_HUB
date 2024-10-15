<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/Community.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/User.php';
class HomePage {
    private User $user;
    private array $unjoinedCommunities = [];
    private array $joinedCommunities = [];

    public function getUnjoinedCommunities(): array {
        return $this->unjoinedCommunities;
    }
    public function setUnjoinedCommunities(array $unjoinedCommunities): void {
        $this->unjoinedCommunities = $unjoinedCommunities;
    }
    public function getJoinedCommunities(): array {
        return $this->joinedCommunities;
    }
    public function setJoinedCommunities(array $joinedCommunities): void {
        $this->joinedCommunities = $joinedCommunities;
    }
    public function getUser(): User {
        return $this->user;
    }
    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function render() {
        echo $this->getHead();
        echo $this->getHeader();
        echo $this->getContainer();
        echo $this->getCreatePopup();
        echo $this->getJoinPopup();
        echo $this->getRoleToggle();
        echo $this->getScripts();
    }

    private function getHead(){
        return '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>&lt;i&gt; Hub</title>
            <link rel="stylesheet" href="..\view\HomePage\HomePage.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <style>
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

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

    private function getContainer() {
        return '
        <div class="container">
            <div class="left-sidebar">
                <nav>
                    <a href="HomePage.html" class="nav-item active"><i class="fas fa-home"></i> Home</a>
                    <a href="/view/AnnouncementPage/announcementPage.html" class="nav-item"><i class="fas fa-bullhorn"></i> Announcement</a>
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
                htmlspecialchars($community->getCommunityName()),
                htmlspecialchars($community->getAmoutOfMembers()),
                htmlspecialchars(implode(' ', $community->getTag()))
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
                htmlspecialchars($community->getCommunityName()),
                htmlspecialchars($community->getAmoutOfMembers()),
                htmlspecialchars(implode(' ', $community->getTag()))
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

    private function renderCommunityCard($name, $members, $tags) {
        return '
        <div class="repeat-commu">
            <a href="../CommunityPage/CommunityPage.html">
                <div class="community-card">
                    <div class="community-image">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="community-info">' . htmlspecialchars($name) . '</div>
                    <div class="community-info">' . htmlspecialchars($members) . '</div>
                    <div class="community-tags">' . htmlspecialchars($tags) . '</div>
                </div>
            </a>
        </div>';
    }

    private function renderDiscoverCommunityCard($name, $members, $tags) {
        return '
        <div class="repeat-discover_commu">
            <div class="community-card discover_commu">
                <div class="community-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="community-info">' . htmlspecialchars($name) . '</div>
                <div class="community-info">' . htmlspecialchars($members) . '</div>
                <div class="community-tags">' . htmlspecialchars($tags) . '</div>
                <div class="locked-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>';
    }

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

    private function getJoinPopup() {
        return '
        <div class="joinPopup-overlay" id="joinPopupOverlay">
            <div class="joinPopup" id="joinPopup">
                <span class="close" id="closeJoinPopup">&times;</span>
                <div class="joinPopup-content">
                    <p style="font-weight: bold; font-size: 24px; margin-bottom: 8px;">Community name 1/67</p>
                    <input type="enrollkey" placeholder="Enter your enroll key." id="enrollkeyInput">
                    <button onclick="JoinSubmit()">Join</button>
                </div>
            </div>
        </div>';
    }

    private function getRoleToggle() {
        return '
        <div class="role-toggle">
            <button id="studentBtn" onclick="selectRole(\'student\')">Student</button>
            <button id="teacherBtn" onclick="selectRole(\'teacher\')">Teacher</button>
            <button id="taBtn" onclick="selectRole(\'ta\')">TA</button>
        </div>';
    }

    private function getScripts() {
        return '<script src="HomePage.js"></script>';
    }
}

// To render the page, create an instance of HomePage and call the render method
$page = new HomePage();
$page->render();
?>
