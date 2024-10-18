<?php

class CommunityPage {
    private User $user;
    private Community $community;
    private array $announcements;

    public function render() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo $this->getHead();
        echo '<body>';
        echo $this->getHeader();
        echo $this->getContainer();
        echo $this->getFooter();
        echo $this->getScripts();
        echo '</body>';
        echo '</html>';
    }

    // Getter and Setter for user
    public function getUser(): User {
        return $this->user;
    }

    private function getUserFNametoShow() {
        return htmlspecialchars($this->getUser()->getFirstname() . ' ' . $this->getUser()->getLastname());
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    // Getter and Setter for community
    public function getCommunity(): Community {
        return $this->community;
    }

    public function setCommunity(Community $community): void {
        $this->community = $community;
    }

    // Getter and Setter for announcements
    public function getAnnouncements(): array {
        return $this->announcements;
    }

    public function setAnnouncements(array $announcements): void {
        $this->announcements = $announcements;
    }

    private function getHead() {
        return '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Community Page</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <link rel="stylesheet" href="\ISAD\view\CommunityPage\CommunityPage.css">
            <style>
                .post-tag {
                    margin-top: 10px;
                    padding: 10px;
                    background-color: #fff;
                    border: 5px solid #a5c7e7;
                    border-radius: 10px;
                }
                .post-button {
                    text-transform: uppercase;
                    font-weight: 1000;
                    padding: 12px 25px;
                    align-self: flex-end;
                }
                .post-button:hover {
                    background-color: #164A7F;
                }
                .post-card{
                    margin-top: 20px;
                    margin-bottom: 5px;
                }
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    private function getHeader() {
        return '
        <header>
            <div class="logo"><a href="/ISAD/controller/Join_Leave_Controller.php">&lt;i&gt; Hub</a></div>
            <div class="search-container">
                <input type="search" class="search-input" placeholder="Search <i>Hub">
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
            ' . $this->getLeftSidebar() . '
            ' . $this->getMainContent() . '
            ' . $this->getRightSidebar() . '
        </div>';
    }

    private function getLeftSidebar() {
        return '
        <nav class="left-sidebar">
            <a href="/ISAD/controller/Join_Leave_Controller.php" class="nav-item">
                <i class="fas fa-home"></i>
                Home
            </a>
            <a href="/ISAD/controller/NotificationController.php?u_id=' . $_SESSION["user_use_now"]->getUserID() . '" class="nav-item">
                <i class="fas fa-bullhorn"></i>
                Announcement
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user"></i>
                Profile Feed
            </a>
        </nav>';
    }

    private function getMainContent() {
        return '
        <main class="main-content">
            ' . $this->getPostCreator() . '
            ' . $this->getPostAnnouncements() . '
        </main>';
    }

    // currently bug, so put type button in those buttons to prevent nav to communityANMcontroller same to x button
    private function getPostCreator() {
        return '
        <form action="/ISAD/controller/Community_ANM_Controller.php" method="GET">
            <div class="post-creator">
                <div class="create-post-header">
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" class="post-input" placeholder="You can post something here.." style="height: 50px;">
                </div>
                <hr>
                <div class="post-actions">
                    <button type="button" class="post-type-btn announcement-btn" id="post-type-announcement" onclick="expandPostCreator(\'announcement\')">
                        <i class="fas fa-bullhorn"></i> Announcement
                    </button>
                    <button type="button" class="post-type-btn" id="post-type-question" onclick="expandPostCreator(\'question\')">
                        <i class="fas fa-question-circle"></i> Question
                    </button>
                    <button type="button" class="post-type-btn" id="post-type-poll" onclick="expandPostCreator(\'poll\')">
                        <i class="fas fa-poll"></i> Poll
                    </button>
                </div>
            </div>
            <div class="expanded-post-creator" style="display: none;">
                <div class="post-header">
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">' . $this->getUserFNametoShow() . '</div>
                        <div class="anonymous-mode" style="display: none;">
                            <span>Anonymous Mode</span>
                            <label class="switch">
                                <input type="checkbox" id="anonymousToggle">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <button type="button" class="close-button">×</button>
                </div>
                <div class="post-content">
                    <div class="post-type-selector">
                        <select id="postTypeSelect">
                            <option value="announcement">Announcement</option>
                            <option value="question">Question</option>
                            <option value="poll">Poll</option>
                        </select>
                    </div>
                    <input type="text" class="post-topic" placeholder="Add Topic..." name="title">
                    <textarea class="post-details" placeholder="Add more details..." name="detail"></textarea>
                </div>
                <div class="post-footer">
                    <div class="tag-section">
                        <p>Tags:</p>
                        <div class="tag-container" id="tagContainer"></div>
                        <input type="text" id="Tags" name="customTag" placeholder="Add Tag like Tag1, Tag2, Tag3" class="post-tag">
                    </div>
                    <button class="post-button" type="submit" name="myButton">Post</button>
                </div>
            </div>
        </form>';
    }

    private function getPostAnnouncements() {
        $html = '';
        foreach ($this->announcements as $announcement) {
            $html .= '
            <div class="post-card">
                <div class="post-header">
                    <div class="post-user">
                        <div class="profile-icon announcement-icon" style="margin-right: 0;">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <strong style="font-weight: bold;">Announcement</strong>
                    </div>
                    <span class="post-time">' . htmlspecialchars($announcement->getAnnouncementCreateDate()) . '</span>
                </div>
                <div class="post-content">
                    <div id="Topic">' . htmlspecialchars($announcement->getAnnouncementTitle()) . '</div>
                    <div id="Detail">' . htmlspecialchars($announcement->getAnnouncementDescription()) . '</div>
                </div>
                <div class="line-post"></div>
                <div class="post-tags">
                    <div class="tags-container">';
            $tags = new Tag_Sql_Controller();
            $tagnows = $tags->getTagByCommunity($this->getCommunity());
            foreach ($tagnows as $tag) {
                $html .= '<span class="post-tag">#' . htmlspecialchars($tag->getTagName()) . '</span>';
            }
            $html .= '
                    </div>
                    <div class="mark-read-btn">
                        <button>Mark As Read</button>
                    </div>
                </div>
            </div>';
        }
        return $html;
    }

    private function getRightSidebar() {
        return '
        <div class="line-right">
            <aside class="right-sidebar">
                ' . $this->getEdit() . '
                <div class="community-image">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/>
                    </svg>
                </div>
                <div class="community-info">
                    <p>Now you are in the</p>

                    <div class="community-name-wrapper">
                        <div class="community-name">' . htmlspecialchars($this->community->getCommunityName()) . '</div>
                        <i class="fa-solid fa-ellipsis" id="leaveBtn"></i>
                    </div>

                    <div id="leave-option" class="leave-option hidden">
                        <a href="/ISAD/controller/Join_Leave_Controller.php?lu_id='.$this->getUser()->getUserID().'&lc_id='.$this->getCommunity()->getCommunityID().'">
                        <div class="leave-header">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Leave Community</span>
                        </div>
                        </a>
                    </div>

                    <div class="sidebar-actions">
                        <a href="#" class="sidebar-action">
                            <i class="fas fa-bullhorn"></i>
                            Announcement
                        </a><hr>
                        <a href="#" class="sidebar-action">
                            <i class="fas fa-question-circle"></i>
                            Question
                        </a><hr>
                        <a href="#" class="sidebar-action">
                            <i class="fas fa-poll"></i>
                            Poll
                        </a>
                    </div>
                </div>
            </aside>
            ' . $this->getAddTA() . '
        </div>';
    }

    private function getEdit(){
        if(!isset($_SESSION["user_use_now"])){
            $role = "S"; // ถ้าไม่มีผู้ใช้ในเซสชันให้เป็น "S"
        }else{
            $role = $_SESSION["user_use_now"]->getRole(); // ถ้ามีผู้ใช้ให้ดึง role
        }
        if ($role != "S"){
            return '
            <div class="settings-icon" style="display: inline-block;" onclick="openEditPopup()">
                <svg viewBox="0 0 24 24">
                    <path d="M19.43 12.98c.04-.32.07-.66.07-1.01s-.03-.69-.07-1.01l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.68-.98l-.38-2.65C14.21 3.18 13.99 3 13.72 3h-3.44c-.27 0-.49.18-.53.43l-.38 2.65c-.61.25-1.16.58-1.68.98l-2.49-1c-.23-.08-.49 0-.61.22l-2 3.46c-.12.22-.07.49.12.64l2.11 1.65c-.04.32-.07.66-.07 1.01s.03.69.07 1.01l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.68.98l.38 2.65c.04.25.26.43.53.43h3.44c.27 0 .49-.18.53-.43l.38-2.65c.61-.25 1.16-.58 1.68-.98l2.49 1c.23.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                </svg>
            </div>';
        }
    }

    private function getAddTA(){
        if (isset($_GET['c_id']) && isset($_GET['u_id'])) {
            // Get the values of 'c_id' and 'u_id'
            $community_id = $_GET['c_id'];
            $user_id = $_GET['u_id'];
        }
        if(!isset($_SESSION["user_use_now"])){
            $role = "S"; // ถ้าไม่มีผู้ใช้ในเซสชันให้เป็น "S"
        }else{
            $role = $_SESSION["user_use_now"]->getRole(); // ถ้ามีผู้ใช้ให้ดึง role
        }
        if ($role != "S"){
            return '
            <div class="add-ta-menu" style="display: inline-block;">
                <span>Teacher Assistant<span id="amount_ta">0</span></span>
                <div>
                    <form method="GET" action = "/ISAD/controller/Communitycontroller.php">
                         <input type="hidden" name="c_id" value="'.$community_id.'">
                        <input type="hidden" name="u_id" value="'.$user_id.'">
                        <input type="text" id="ta_id" name="ta_id" placeholder="Enter ID here"><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>';
        }
    }

    private function getFooter() {
        return '
        <script>
            let leaveBtn = document.querySelector("#leaveBtn")
            const leaveOption = document.getElementById("leave-option");
            leaveBtn.addEventListener("click", ()=> {
                leaveOption.style.display = (leaveOption.style.display === "none" || leaveOption.style.display === "") ? "block" : "none";
            })
            document.addEventListener("click", (e)=> {
                const toggleButton = document.querySelector(".fa-ellipsis")
                if (leaveOption.style.display === "block" && !leaveOption.contains(e.target) && !toggleButton.contains(e.target)) {
                    leaveOption.style.display = "none"
                }
            })
        </script>
        <footer>
            <p>&copy; 2023 Community Page</p>
        </footer>';
    }

    // ส่วนของ Scripts
    private function getScripts() {
        return '<script src="/ISAD/view/CommunityPage/CommunityPage.js"></script>'; // เปลี่ยนเป็น path ที่ถูกต้อง
    }
}


// To render the page, create an instance of CommunityPage and call the render method
// $page = new CommunityPage();
// $page->render();
?>
