<?php

require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/Announcement.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/Tag.php';
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
                $announcements[] = $announcement;
            }
            return $announcements;
        } else {
            return [];
        }
    }

    public function getAnnouncementByID($id): Announcement{
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

    public function getAnnouncementsByCommunity($c_id): array {
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

    public function createAnnouncement($name, $discription, $c_id, $u_id): bool {
        $sql = "INSERT INTO announcement (anm_name, anm_description, c_id, u_id) VALUES ('$name', '$discription', $c_id, $u_id)";
        return $this->query($sql);
    }

    public function addtag($announcement, $tag): bool {
        $sql = "INSERT INTO announcement_tag (anm_id, t_id) VALUES ($announcement->getAnnouncementID(), $tag->getTagID())";
        return $this->query($sql);
    }

    public function removeAnnouncement($announcement): bool {
        $sql = "DELETE FROM announcement WHERE anm_id = $announcement->getAnnouncementID()";
        return $this->query($sql);
    }

}
?>