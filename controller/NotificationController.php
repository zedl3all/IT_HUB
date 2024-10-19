<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once 'Community_ANM_Controller.php';

class NotificationController {
    private $notiSqlController;
    private $cmuntyANMCtrl;
    private $usersql;
    private $communitysql;
    private $tagsql;
    private $user;
    private $notifypage;

    public function __construct() {
        $this->notiSqlController = new Notification_Sql_Controller();
        $this->cmuntyANMCtrl = new Community_ANM_Controller();
        $this->usersql = new User_Sql_Controller();
        $this->communitysql = new Community_Sql_Controller();
        $this->tagsql = new Tag_Sql_Controller();
        
        // Check if session is not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        ob_start();
        
        try {
            if (isset($_GET['u_id'])) {
                $u_id = $_GET['u_id'];
                $this->user = $this->usersql->getUserByID($u_id);
                if ($this->user === null) {
                    throw new Exception("User not found");
                }
            } else {
                throw new Exception("User ID not provided");
            }

            // Assuming getAnnouncementsByUserID is a method that fetches announcements for a user
            // $notify = $this->announcesql->getAnnouncementsByUserID($this->user->getUserID());
        
        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }

        $this->notifypage = new AnnouncementPage();
        $this->notifypage->setUser($this->user);
    }

    public function getacmuntyANMCtrl() : Community_ANM_Controller {
        return $this->cmuntyANMCtrl;
    }

    public function getNotiSqlController() : Notification_Sql_Controller {
        return $this->notiSqlController;
    }

    public function getCommunitysqlController() : Community_Sql_Controller {
        return $this->communitysql;
    }

    public function getUsersqlContoller() : User_Sql_Controller {
        return $this->usersql;
    }

    public function gettagsqlContoller() : Tag_Sql_Controller {
        return $this->tagsql;
    }

    public function createNotification($noti_id, $community_id, $user_id, $announce_id, $seen) {
        $this->notiSqlController->insertNotification($noti_id, $community_id, $user_id, $announce_id, $seen);
    }

    public function markAsRead($notify) {
        $this->notiSqlController->setSeenNotification($notify);
    }

    public function getCountUnseenNotify($user) {
        return $this->notiSqlController->getCountUnseenNotify($user);
    }

    public function getnotifypage() {
        return $this->notifypage;
    }
}

$controller = new NotificationController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_as_read'])) {
    // $amn = $controller->announcesql->getAnnouncementByID($_POST['announcement_id']);
    $announcement_id = $_POST['announcement_id'];
    $user_id = $_POST['user_id'];
    $amn = $controller->getacmuntyANMCtrl()->getanmAccess()->getAnnouncementByID($announcement_id);
    $user = $controller->getUsersqlContoller()->getUserByID($user_id);

    // echo $amn->getAnnouncementID();
    if ($amn !== null) {
        $notifychan = $controller->getNotiSqlController()->getNotificationByAnmID($amn, $user);
        if ($notifychan !== null) {
            $controller->markAsRead($notifychan);
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$controller->getnotifypage()->render();
ob_end_flush();
?>