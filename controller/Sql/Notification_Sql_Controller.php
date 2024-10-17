<?php
require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
class Notification_Sql_Controller extends SqlController {
    public function getNotifications(): array {
        $sql = "SELECT * FROM notification";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotificationId($row['n_id']);
                $notification->setCommunityId($row['c_id']);
                $notification->setUserId($row['u_id']);
                $notification->setAnnouncementId($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getNotificationByID(int $id): Notification{
        $sql = "SELECT * FROM notification WHERE id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notification = new Notification();
            $notification->setNotificationId($row['n_id']);
            $notification->setCommunityId($row['c_id']);
            $notification->setUserID($row['u_id']);
            $notification->setAnnouncementId($row['anm_id']);
            $notification->setSeen($row['n_is_seen']);
            return $notification;
        } else {
            return null;
        }
    }

    public function getNotificationsByCommu(Community $commu): array {
        $sql = "SELECT * FROM notification WHERE c_id = {$commu->getCommunityID()}";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotificationId($row['n_id']);
                $notification->setCommunityId($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnnouncementId($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getNotificationsByUser(User $user): array {
        $sql = "SELECT * FROM notification WHERE u_id = {$user->getUserID()}";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
          $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotificationId($row['n_id']);
                $notification->setCommunityId($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnnouncementId($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getUnseenNotificationsByUser(User $user): array {
        $sql = "SELECT * FROM notification WHERE u_id = {$user->getUserID()} AND n_is_seen = 0";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotificationId($row['n_id']);
                $notification->setCommunityId($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnnouncementId($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getSeenNotificationsByUser(User $user): array {
        $sql = "SELECT * FROM notification WHERE u_id = {$user->getUserID()} AND n_is_seen = 1";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotificationId($row['n_id']);
                $notification->setCommunityId($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnnouncementId($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getCountUnseenNotification(User $user): int {
        $sql = "SELECT count(n_is_seen) as unseen_count FROM notification WHERE u_id = {$user->getUserID()} AND n_is_seen = 0";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['unseen_count'];
        } else {
            return 0;
        }
    }

    public function setSeenNotification(Notification $notification): bool {
        $sql = "UPDATE notification SET n_is_seen = 1 WHERE n_id = {$notification->getNotificationId()}";
        return $this->query($sql);
    }

    public function createNotification(int $c_id, int $u_id, int $anm_id, bool $n_is_seen): bool {
        $sql = "INSERT INTO notification (c_id, u_id, anm_id, n_is_seen) VALUES ($c_id, $u_id, $anm_id, $n_is_seen)";
        return $this->query($sql);
    }
}
?>  