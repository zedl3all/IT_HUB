<?php
include '../controller/Notification_Sql_Controller.php';
class NotificationController{
    private $notiSqlController;

    private $user;
    private $community;
    private $announcement;

    public function crateNotification($noti_id, $coummunity_id, $user_id, $announce_id, $seen){

    }
    public function showNotificationAnnouncement($notify){

    }

    public function markAsRead($notify) {
        $this->notiSqlController->setSeenNotification($notify);
    }

    public function getCountUnseenNotify($notify) {
        $this->notiSqlController->getCountUnseenNotify($user);
    }

}

?>