<?php
class Notification_Sql_Controller extends SqlController {
    public function getNotifications(): array {
        $sql = "SELECT * FROM notification";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotiID($row['n_id']);
                $notification->setCommuID($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnmID($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getNotificationByID($id): Notification{
        $sql = "SELECT * FROM notification WHERE id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notification = new Notification();
            $notification->setNotiID($row['n_id']);
            $notification->setCommuID($row['c_id']);
            $notification->setUserID($row['u_id']);
            $notification->setAnmID($row['anm_id']);
            $notification->setSeen($row['n_is_seen']);
            return $notification;
        } else {
            return null;
        }
    }

    public function getNotificationsByCommu($commu): array {
        $sql = "SELECT * FROM notification WHERE c_id = $commu->getCommuID()";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotiID($row['n_id']);
                $notification->setCommuID($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnmID($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getNotificationsByUser($user): array {
        $sql = "SELECT * FROM notification WHERE u_id = $user->getUserID()";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotiID($row['n_id']);
                $notification->setCommuID($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnmID($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getUnseenNotificationsByUser($user): array {
        $sql = "SELECT * FROM notification WHERE u_id = $user->getUserID() AND n_is_seen = 0";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotiID($row['n_id']);
                $notification->setCommuID($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnmID($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function getSeenNotificationsByUser($user): array {
        $sql = "SELECT * FROM notification WHERE u_id = $user->getUserID() AND n_is_seen = 1";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $notifications = [];
            while($row = $result->fetch_assoc()) {
                $notification = new Notification();
                $notification->setNotiID($row['n_id']);
                $notification->setCommuID($row['c_id']);
                $notification->setUserID($row['u_id']);
                $notification->setAnmID($row['anm_id']);
                $notification->setSeen($row['n_is_seen']);
                $notifications[] = $notification;
            }
            return $notifications;
        } else {
            return [];
        }
    }

    public function setSeenNotification($notification): bool {
        $sql = "UPDATE notification SET n_is_seen = 1 WHERE n_id = $notification->getNotiID()";
        return $this->query($sql);
    }

    public function createNotification($c_id, $u_id, $anm_id, $n_is_seen): bool {
        $sql = "INSERT INTO notification (c_id, u_id, anm_id, n_is_seen) VALUES ($c_id, $u_id, $anm_id, $n_is_seen)";
        return $this->query($sql);
    }
}
?>