/* The `Page` class in PHP renders a home page with header, sidebar, community sections, and
interactive popups. */
<?php

require_once "../controller/Community_Sql_controller.php";
require_once "../model/Community.php";

class Page {
    private $sql_Community;
    private $myCommunities;
    private $discoverCommunities;

    public function __construct() {

        $this->sql_Community = new Community_Sql_controller();
        // กำหนดข้อมูลชุมชน
        $this->myCommunities = [];

        $temp = $this->sql_Community->getCommunityByID(1);
        $temp->setEnroll("1234");
        $this->discoverCommunities = [$temp];
    }

    public function renderHeader() {
        echo '<header>
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

    public function renderSidebar() {
        echo '<div class="left-sidebar">
                <nav>
                    <a href="#" class="nav-item active"><i class="fas fa-home"></i> Home</a>
                    <a href="#" class="nav-item"><i class="fas fa-bullhorn"></i> Announcement</a>
                    <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
                </nav>
            </div>';
    }

    public function renderCommunity($communities) {
        foreach ($communities as $community) {
            if ($community->getEnroll() != "") {
                // Community ที่มีรหัสผ่าน
                echo '<div class="repeat-commu" onclick="openPopup(\'' . htmlspecialchars($community->getCommunityName()) . '\')">
                        <div class="community-card">
                            <div class="community-image">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="community-info">' . htmlspecialchars($community->getCommunityName()) . '</div>
                            <div class="community-info">' . htmlspecialchars($community->getAmoutOfMembers()) . '</div>
                        </div>
                    </div>';
            } else {
                // Community ที่ไม่มีรหัสผ่าน
                echo '<div class="repeat-commu">
                        <a href="CommunityPage.php">
                            <div class="community-card">
                                <div class="community-image">
                                    <i class="fas fa-image"></i>
                                </div>
                                <div class="community-info">' . htmlspecialchars($community->getCommunityName()) . '</div>
                                <div class="community-info">' . htmlspecialchars($community->getAmoutOfMembers()) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        }
    }

    public function render() {
        // HTML Header
        echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Home Page</title>
                  <link rel="stylesheet" href="HomePage.css">
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                  <style>
                      @import url(\'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap\');
                  </style>
              </head>
              <body>';

        // Render Header and Sidebar
        $this->renderHeader();
        echo '<div class="container">';
        $this->renderSidebar();

        // Main Content
        echo '<main>
                <button class="create-community">Create Community</button>
                <section>
                    <h2 style="border-bottom: 2px solid white; padding-bottom: 16px;">My Community</h2>
                    <div class="community-grid">';
        $this->renderCommunity($this->myCommunities);
        echo '      </div>
                    </section>
                    <section>
                        <h2 style="border-top: 2px solid white; border-bottom: 2px solid white; margin-top: 16px; padding-top: 16px; padding-bottom: 16px;">Discover Community</h2>
                        <div class="community-grid">';
        $this->renderCommunity($this->discoverCommunities);
        echo '          </div>
                    </section>
                </main>
              </div>
              <div class="popup-overlay" id="popupOverlay" style="display:none;">
                  <div class="popup" id="popup">
                      <span class="close" id="closePopup" onclick="closePopup()">&times;</span>
                      <div class="popup-content">
                          <p style="font-weight: bold; font-size: 24px; margin-bottom: 8px;" id="popupTitle">Community name</p>
                          <input type="password" placeholder="Enter your enroll key." id="enrollkeyInput">
                          <button onclick="submitForm()">Join</button>
                      </div>
                  </div>
              </div>
              <div class="role-toggle">
                  <button class="active">Student</button>
                  <button>Teacher</button>
                  <button>TA</button>
              </div>
              <script>
                  function openPopup(communityName) {
                      document.getElementById("popupTitle").innerText = communityName;
                      document.getElementById("popupOverlay").style.display = "block";
                  }

                  function closePopup() {
                      document.getElementById("popupOverlay").style.display = "none";
                  }

                  function submitForm() {
                      // Implement your join logic here
                      closePopup();
                  }
              </script>
              <script src="HomePage.js"></script>
              </body>
              </html>';
    }
}

$page = new Page();
$page->render();
