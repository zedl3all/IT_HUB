<?php

class AnnouncementPage {
    // This function will output the HTML content
    public function render() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo $this->getHead();
        echo '<body>';
        echo $this->getHeader();
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

    private function getMainContent() {
        return '
        <div class="container">
            <nav class="left-sidebar">
                <a href="/HomePage/HomePage.html" class="nav-item"><i class="fas fa-home"></i> Home</a>
                <a href="/AnnouncementPage/announcementPage.html" class="nav-item active"><i class="fas fa-bullhorn"></i> Announcement</a>
                <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile Feed</a>
            </nav>
            <main class="main-content">
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="profile-icon"><i class="fas fa-bullhorn"></i></div>
                            <strong>Announcement</strong>
                        </div>
                        <span class="post-time">1 days ago</span>
                    </div>
                    <div class="post-content">Post Content</div>
                    <div class="post-tags">
                        <span class="post-tag" id="tag1">#code</span>
                        <span class="post-tag" id="tag2">#announcement</span>
                    </div>
                    <div class="line-post" style="border-top: 2px solid #90A7BA; margin-bottom: 8px;"></div>
                    <div class="post-author" style="margin-bottom: 16px; margin-top: 16px;">
                        <div class="profile-icon user-profile"><i class="fas fa-user"></i></div>
                        <div>Post by : Firstname Lastname</div>
                    </div>
                    <div class="post-author">
                        <div class="profile-icon user-profile"><i class="fa-solid fa-users"></i></div>
                        <div>Community : Community name</div>
                    </div>
                </div>
            </main>
            <div style="margin-right: 264px;"></div>
        </div>';
    }

    private function getFooter() {
        return '';
    }
}

?>