<?php

require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
class Announcement_Sql_Controller extends SqlController {
    public function getAnnouncements(): array {
        $sql = "SELECT * FROM announcement ORDER BY anm_create_date DESC";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $announcements = [];
            while($row = $result->fetch_assoc()) {
                $announcement = new Announcement();
                $announcement->setAnnouncementID($row['anm_id']);
                $announcement->setAnnouncementTitle($row['anm_name']);
                $announcement->setAnnouncementDescription($row['anm_description']);
                $announcement->setAnnouncementCreateDate($row['anm_create_date']);
                $announcement->setAnnouncementUserId($row['u_id']);
                $announcement->setAnnouncementCommunityId($row['c_id']);
                $announcements[] = $announcement;
            }
            return $announcements;
        } else {
            return [];
        }
    }

    public function getAnnouncementByID(int $id): Announcement{
        $sql = "SELECT * FROM announcement WHERE id = $id ORDER BY anm_create_date DESC";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $announcement = new Announcement();
            $announcement->setAnnouncementID($row['anm_id']);
            $announcement->setAnnouncementTitle($row['anm_name']);
            $announcement->setAnnouncementDescription($row['anm_description']);
            $announcement->setAnnouncementCreateDate($row['anm_create_date']);
            return $announcement;
        } else {
            return null;
        }
    }

    public function getAnnouncementsByCommunity(int $c_id): array {
        $sql = "SELECT * FROM announcement WHERE c_id = $c_id ORDER BY anm_create_date DESC";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $announcements = [];
            while($row = $result->fetch_assoc()) {
                $announcement = new Announcement();
                $announcement->setAnnouncementID($row['anm_id']);
                $announcement->setAnnouncementTitle($row['anm_name']);
                $announcement->setAnnouncementDescription($row['anm_description']);
                $announcement->setAnnouncementCreateDate($row['anm_create_date']);
                $announcements[] = $announcement;
            }
            return $announcements;
        } else {
            return [];
        }
    }

    public function getAnnouncementByLast(int $u_id): Announcement{
        $sql = "SELECT * FROM announcement WHERE u_id = $u_id ORDER BY anm_create_date DESC LIMIT 1";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $announcement = new Announcement();
            $announcement->setAnnouncementID($row['anm_id']);
            $announcement->setAnnouncementTitle($row['anm_name']);
            $announcement->setAnnouncementDescription($row['anm_description']);
            $announcement->setAnnouncementCreateDate($row['anm_create_date']);
            return $announcement;
        } else {
            return null;
        }
    }

    public function createAnnouncement(string $name, string $discription, int $c_id, int $u_id): bool {
        $sql = "INSERT INTO announcement (anm_name, anm_description, c_id, u_id) VALUES ('$name', '$discription', $c_id, $u_id)";
        return $this->query($sql);
    }

    public function addtag(Announcement $announcement, array $tags): bool {
        foreach ($tags as $t) {
            $sql = "INSERT INTO announcement_tag (anm_id, t_id) VALUES ('{$announcement->getAnnouncementID()}', '{$t->getTagID()}')";
            if (!$this->query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function removeAnnouncement(Announcement $announcement): bool {
        $sql = "DELETE FROM announcement WHERE anm_id = {$announcement->getAnnouncementID()}";
        return $this->query($sql);
    }

}
?>