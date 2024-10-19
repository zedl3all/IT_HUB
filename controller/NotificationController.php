<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

class NotificationController {
    private $notiSqlController;
    private $anmAccess;
    private $usersql;
    private $tagsql;
    private $user;
    private $notifypage;

    public function __construct() {
        $this->notiSqlController = new Notification_Sql_Controller();
        $this->announcesql = new AnnouncementAccess();
        $this->usersql = new User_Sql_Controller();
        $this->tagsql = new Tag_Sql_Controller();
        ob_start();
        session_start();
        
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

    public function getanmAccess() : AnnouncementAccess {
        return $this->anmAccess;
    }

    public function getNotiSqlController() : Notification_Sql_Controller {
        return $this->notiSqlController;
    }

    public function getUsersqlContoller() : User_Sql_Controller {
        return $this->usersql;
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
    $amn = $controller->getanmAccess()->getAC()->getAnnounementSQL()->getAnnouncementByID($announcement_id);
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