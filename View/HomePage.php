<?php

require_once '..//controller//Sql/Community_Sql_controller.php';
require_once '..//controller//Sql//User_Sql_controller.php';
require_once '..//model//Community.php';
require_once '..//model//User.php';
class HomePage {
    private $community_sql_controller = null;
    private $user_sql_controller = null;
    private $Join_community = [];
    private $UnJoin_community = [];
    private $user = null;

    public function __construct() {
        // You can initialize any necessary properties or data here
        $this->community_sql_controller = new Community_Sql_controller();
        $this->user_sql_controller = new User_Sql_controller();
        $this->user = $this->user_sql_controller->getUserByID(1);
        $this->user->getUserID();
        $this->Join_community = $this->community_sql_controller->getJoinedCommunities($this->user);
    }

    // This function will output the HTML content
    public function render() {
        echo $this->getHead();
        echo $this->getHeader();
        echo $this->getMainContent();
        echo $this->getPopup();
        echo $this->getRoleToggle();
        echo $this->getFooter();
    }

    private function getHead(){
        return '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>&lt;i&gt; Hub</title>
            <link rel="stylesheet" href="HomePage.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <style>
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    // Get Header Section
    private function getHeader() {
        return '
        <header>
            <div class="logo">
                <a href="HomePage.php">&lt;i&gt; Hub</a>
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

    // Get Main Content Section
    private function getMainContent() {
        return '
        <div class="container">
            <div class="left-sidebar">
                <nav>
                    <a href="#" class="nav-item active"><i class="fas fa-home"></i> Home</a>
                    <a href="#" class="nav-item"><i class="fas fa-bullhorn"></i> Announcement</a>
                    <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
                </nav>
            </div>
            <main>
                <button class="create-community">Create Community</button>
                <section>
                    <h2 style="border-bottom: 2px solid white; padding-bottom: 16px;">My Community</h2>
                    <div class="community-grid">
                        ' . $this->getCommunityCards() . '
                    </div>
                </section>
                <section>
                    <h2 style="border-top: 2px solid white; border-bottom: 2px solid white; margin-top: 16px; padding-top: 16px; padding-bottom: 16px;">Discover Community</h2>
                    <div class="community-grid">
                        ' . $this->getDiscoverCommunityCards() . '
                    </div>
                </section>
            </main>
        </div>';
    }

    // Get Community Cards for "My Community" section
    private function getCommunityCards() {
        // You can replace the below static content with dynamic data or a loop fetching community information
        return '
        <div class="repeat-commu">
            <a href="CommunityPage.php">
                <div class="community-card">
                    <div class="community-image">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="community-info">Community name</div>
                    <div class="community-info">1/67</div>
                </div>
            </a>
        </div>
        <div class="repeat-commu">
            <a href="CommunityPage.php">
                <div class="community-card">
                    <div class="community-image">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="community-info">Community name</div>
                    <div class="community-info">1/67</div>
                </div>
            </a>
        </div>';
    }

    // Get Community Cards for "Discover Community" section
    private function getDiscoverCommunityCards() {
        return '
        <div class="repeat-discover_commu">
            <div class="community-card discover_commu">
                <div class="community-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="community-info">Community name</div>
                <div class="community-info">1/67</div>
                <div class="locked-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>
        <div class="repeat-discover_commu">
            <div class="community-card discover_commu">
                <div class="community-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="community-info">Community name</div>
                <div class="community-info">1/67</div>
                <div class="locked-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>';
    }

    // Get Popup Section
    private function getPopup() {
        return '
        <div class="popup-overlay" id="popupOverlay">
            <div class="popup" id="popup">
                <span class="close" id="closePopup">&times;</span>
                <div class="popup-content">
                    <p style="font-weight: bold; font-size: 24px; margin-bottom: 8px;">Community name 1/67</p>
                    <input type="enrollkey" placeholder="Enter your enroll key." id="enrollkeyInput">
                    <button onclick="submitForm()">Join</button>
                </div>
            </div>
        </div>';
    }

    // Get Role Toggle Section
    private function getRoleToggle() {
        return '
        <div class="role-toggle">
            <button class="active">Student</button>
            <button>Teacher</button>
            <button>TA</button>
        </div>';
    }

    // Get Footer Section
    private function getFooter() {
        return '<script src="HomePage.js"></script>';
    }
}

// Create an instance of the HomePage class
$page = new HomePage();
$page->render();

?>
