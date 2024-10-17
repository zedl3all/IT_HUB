<?php
require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

class Tag_Sql_Controller extends SqlController {
    public function getTags(): array {
        $sql = "SELECT * FROM tag";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $tags = [];
            while($row = $result->fetch_assoc()) {
                $tag = new Tag();
                $tag->setTagID($row['t_id']);
                $tag->setTagName($row['t_name']);
                $tags[] = $tag;
            }
            return $tags;
        } else {
            return [];
        }
    }

    public function getTagByID(int $id): Tag{
        $sql = "SELECT * FROM tag WHERE t_id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tag = new Tag();
            $tag->setTagID($row['t_id']);
            $tag->setTagName($row['t_name']);
            return $tag;
        } else {
            return null;
        }
    }

    public function getTagByName(string $name): Tag{
        $sql = "SELECT * FROM tag WHERE t_name = $name";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tag = new Tag();
            $tag->setTagID($row['t_id']);
            $tag->setTagName($row['t_name']);
            return $tag;
        } else {
            return null;
        }
    }

    public function createTag(string $name, string $description): bool {
        $sql = "INSERT INTO tag (t_name, t_description) VALUES ('$name', '$description')";
        return $this->query($sql);
    }

    public function getTagByCommunity(Community $commu): array {
        $sql = "SELECT * FROM tag WHERE t_id IN (SELECT t_id FROM community_tag WHERE c_id = {$commu->getCommunityID()})";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $tags = [];
            while($row = $result->fetch_assoc()) {
                $tag = new Tag();
                $tag->setTagID($row['t_id']);
                $tag->setTagName($row['t_name']);
                $tags[] = $tag;
            }
            return $tags;
        } else {
            return [];
        }
    }

    public function getTagByAnnouncement(Announcement $anm): array {
        $sql = "SELECT * FROM tag WHERE t_id IN (SELECT t_id FROM announcement_tag WHERE anm_id = {$anm->getAnnouncementID()})";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $tags = [];
            while($row = $result->fetch_assoc()) {
                $tag = new Tag();
                $tag->setTagID($row['t_id']);
                $tag->setTagName($row['t_name']);
                $tags[] = $tag;
            }
            return $tags;
        } else {
            return [];
        }
    }

    
}
?>