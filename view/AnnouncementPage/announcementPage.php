<?php

class AnnouncementPage {
    private User $user;
    private Community $community;


    public function getUserAn(): User {
        return $this->user;
    }

    public function setUserAn(User $user): void {
        $this->user = $user;
    }

    // Getter and Setter for community
    public function getCommunityAn(): Community {
        return $this->community;
    }

    public function setCommunityAn(Community $community): void {
        $this->community = $community;
    }
    public function render() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo $this->getHead();
        echo '<body>';
        echo $this->getHeader();
        echo $this->getLeftSlideBar();
        echo $this->getMainContent();
        echo $this->getFooter();
        echo '</body>';
        echo '</html>';
    }

    private function getHead() {
        return '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Announcement</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <link rel="stylesheet" href="/ISAD/view/AnnouncementPage/announcementPage.css">
            <style>
                .post-card{
                    margin-bottom: 30px;
                }
                .post-card:first-child{
                    margin-top: 20px;
                }   
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    private function getHeader() {
        return '
        <header>
            <div class="logo"><a href="/CommunityPage/CommunityPage.html">&lt;i&gt; Hub</a></div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search <i>Hub">
            </div>
            <div class="user-section">
                <div class="notification-bell">
                    <i class="fas fa-bell" id="bell-icon"></i>
                    <span class="notification-count" id="notification-count">1</span>
                </div>
                <div class="notification-icon"></div>
                <div class="profile-icon user-profile"></div>
            </div>
        </header>';
    }

    private function getLeftSlideBar() {
        return '
        <div class="container">
            <nav class="left-sidebar">
                <a href="/ISAD/controller/Join_Leave_Controller.php" class="nav-item"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="nav-item active"><i class="fas fa-bullhorn"></i> Announcement</a>
                <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
            </nav>';
    }

    private function getMainContent() {
        $anmC = new Announcement_Sql_Controller();
        $announcements = $anmC->getAnnouncements();
        $output = '<main class="main-content">';
    
        if (!empty($announcements)) {
            foreach ($announcements as $announcement) {
                $output .= '
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="profile-icon"><i class="fas fa-bullhorn"></i></div>
                            <strong>' . htmlspecialchars($announcement->getAnnouncementTitle()) . '</strong>
                        </div>
                        <span class="post-time">' . htmlspecialchars($announcement->getAnnouncementCreateDate()) . '</span>
                    </div>
                    <div class="post-content">' . htmlspecialchars($announcement->getAnnouncementDescription()) . '</div>
                    <div class="post-tags">';
                    
                // เริ่มต้นการวนลูปเพื่อแสดง tags
                $tags = $announcement->getAnnouncementTag(); // สมมติว่า getAnnouncementTag() คืนค่า array ของ tags
                foreach ($tags as $tag) {
                    $output .= '<span class="post-tag">#' . htmlspecialchars($tag) . '</span>';
                }
                
                $output .= '</div>'; // ปิด div.post-tags
                $output .= '
                    <div class="line-post" style="border-top: 2px solid #90A7BA; margin-bottom: 8px;"></div>
                    <div class="post-author" style="margin-bottom: 16px; margin-top: 16px;">
                        <div class="profile-icon user-profile"><i class="fas fa-user"></i></div>
                        <div>Post by: '. htmlspecialchars($this->user->getFirstname()) . '</div>
                    </div>
                    <div class="post-author">
                        <div class="profile-icon user-profile"><i class="fa-solid fa-users"></i></div>
                        <div>Community: '. htmlspecialchars($this->community->getCommunityName()) . '</div>
                    </div>
                </div>'; // ปิด div.post-card
            }
        } else {
            $output .= '<p>No announcements available.</p>';
        }
        $output .= '</main><div style="margin-right: 264px;"></div></div>';
        return $output;
    }
    

    private function getFooter() {
        return '';
    }
}

?>
