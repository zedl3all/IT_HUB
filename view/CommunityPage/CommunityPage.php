<?php

class CommunityPage {

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
            <title>Community Page</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <link rel="stylesheet" href="CommunityPage.css">
            <style>
                @import url(\'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap\');
            </style>
        </head>';
    }

    private function getHeader() {
        return '
        <header>
            <div class="logo"><a href="/HomePage/HomePage.html">&lt;i&gt; Hub</a></div>
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
            <!-- left side เป็นฝั่งของโดยรวม เช่น announcement จะเป็น announcement ของทุก commu ที่เราอยู่-->
            <nav class="left-sidebar">
                <a href="/HomePage/HomePage.html" class="nav-item active">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-bullhorn"></i>
                    Announcement
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-user"></i>
                    Profile Feed
                </a>
            </nav>
        
            <main class="main-content">
                <div class="post-creator">
                    <div class="create-post-header">
                        <div class="profile-icon"><i class="fas fa-user"></i></div> <!-- รูป profile ยืด-->
                        <input type="text" class="post-input" placeholder="Create Announcement, Question or Poll">
                    </div>
                    <hr><br>
                    <div class="post-actions">
                        <button class="post-type-btn">
                            <i class="fas fa-bullhorn"></i>
                            Announcement
                        </button>
                        <button class="post-type-btn">
                            <i class="fas fa-question-circle"></i>
                            Question
                        </button>
                        <button class="post-type-btn">
                            <i class="fas fa-poll"></i>
                            Poll
                        </button>
                    </div>
                </div>
        
                
                <!-- เป็นส่วน post content
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="profile-icon"><i class="fas fa-user"></i></div>
                            <div>
                                <div>Firstname Lastname</div>
                                <div class="post-time">Just now</div>
                            </div>
                        </div>
                        <i class="fas fa-ellipsis-h threedot"></i>
                    </div>
                    <div class="post-content">
                        Post Content
                    </div>
                    <div class="post-actions-bottom">
                        <div class="action-btn">
                            <i class="far fa-comment"></i>
                            Comment
                        </div>
                    </div>
                    <div class="comment-input-container">
                        <div class="profile-icon"><i class="fas fa-user"></i></div>
                        <input type="text" class="comment-input" placeholder="Write a comment">
                    </div>
                </div> -->
        
            </main>
            
            <!-- right side เป็นฝั่งของ community เช่น เรียกดู announcement ของใน community ที่อยู่ ณ ตอนนั้น-->
            <div class="line-right">
                <aside class="right-sidebar">
                    <div class="community-image">
                        <svg viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/>
                        </svg>
                    </div>
                    <div class="community-info">
                        <p>Now you in the</p>
                        <div class="community-name">Community Name</div><hr>
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
            </div>
        </div>';
    }
}

// To render the page, create an instance of HomePage and call the render method
$page = new CommunityPage();
$page->render();
?>
