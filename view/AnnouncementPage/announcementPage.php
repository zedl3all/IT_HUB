<?php

class AnnouncementPage {
    private User $user;
    // private array $announcements;

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

    // Getter and Setter for user
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
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
                .container-mark-as-read {
                    margin-left: auto;
                    margin-right: 0;
                }
                .noti-an {
                    position: absolute;
                    right: 55px;
                    top: 10px;
                    border-radius: 50%;
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    display: none;
                }
                .nav-item {
                    position: relative;
                }
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    private function getHeader() {
        return '
        <header>
            <div class="logo"><a href="#">&lt;i&gt; Hub</a></div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search <i>Hub">
            </div>
            <div class="user-section">
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
                <a href="#" class="nav-item active">
                    <i class="fas fa-bullhorn">
                    <div class="noti-an">&nbsp;</div>
                    </i> Announcement</a>
                <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
            </nav>';
    }

    private function getMainContent() {
        $notianm = new Notification_Sql_Controller();
        $usersql = new User_Sql_Controller();
        $commusql = new Community_Sql_Controller();
        $notiSqlController = new Notification_Sql_Controller();
        $announcements = $notianm->getNotificationAnnouncementByUser($this->user);
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
                    
                // Loop to display tags
                $tags = new Tag_Sql_Controller();
                $tagnows = $tags->getTagByAnnouncement($announcement);
                foreach ($tagnows as $tag) {
                    $output .= '<span class="post-tag">#' . htmlspecialchars($tag->getTagName()) . '</span>';
                }
                
                $output .= '</div>'; // Close div.post-tags
                $output .= '
                    <div class="line-post" style="border-top: 2px solid #90A7BA; margin-bottom: 8px;"></div>
                    <div class="post-author" style="margin-bottom: 16px; margin-top: 16px;">
                        <div class="profile-icon user-profile"><i class="fas fa-user"></i></div>
                        <div>Post by: '. htmlspecialchars($usersql->getUserByID($announcement->getAnnouncementUserId())->getFirstname()) . '</div>
                    </div>
                    <div class="post-author">
                        <div class="profile-icon user-profile"><i class="fa-solid fa-users"></i></div>
                        <div>Community: '. htmlspecialchars($commusql->getCommunityByID($announcement->getAnnouncementCommunityId())->getCommunityName()) . '</div>';

                // Fetch notification status
                $notification = $notiSqlController->getNotificationByAnmID($announcement);
                if ($notification !== null && !$notification->isSeen()) {
                    $output .= '
                        <form method="post" action="/ISAD/controller/NotificationController.php" class="container-mark-as-read">
                            <input type="hidden" name="announcement_id" value="' . htmlspecialchars($announcement->getAnnouncementID()) . '">
                            <button type="submit" name="mark_as_read" class="mark-as-read">Mark As Read</button>
                        </form>';
                }

                $output .= '</div>'; // Close div.post-author
                $output .= '</div>'; // Close div.post-card
            }
        } else {
            $output .= '<p>No announcements available.</p>';
        }
        $output .= '</main><div style="margin-right: 264px;"></div></div>';
        return $output;
    }
    

    private function getFooter() {
        $noti = new Notification_Sql_Controller();
        $countNoti = $noti->getCountUnseenNotification($_SESSION["user_use_now"]);
        return '<script>
            const btnMark = document.querySelectorAll(".mark-as-read")
            console.log(btnMark)
            for(let i = 0; i < btnMark.length; i++){
                btnMark[i].addEventListener("click", ()=> {
                    btnMark[i].style.display = "none"
                })
            }
            const noti = document.querySelector(".noti-an")
            let notisql = '.$countNoti.';
            console.log(notisql)
            if(notisql > 0){
                noti.style.display = "block"
            }else{
                noti.style.display = "none"
            }
        </script>';
    }
}

// To render the page, create an instance of CommunityPage and call the render method
// $page = new AnnouncementPage();
// $page->render();

?>
