<?php

require_once 'SqlController.php';
require_once '../model/Community.php';
require_once '../model/Tag.php';
require_once '../model/User.php';

class Community_Sql_Controller extends SqlController {
    public function getCommunities(): array {
        $sql = "SELECT * FROM community";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $communities = [];
            while($row = $result->fetch_assoc()) {
                $community = new Community();
                $community->setCommunityID($row['c_id']);
                $community->setCommunityName($row['c_name']);
                $community->setCommunityDescription($row['c_description']);
                $community->setCommunityCreateDate($row['c_create_date']);
                $communities[] = $community;
            }
            return $communities;
        } else {
            return [];
        }
    }

    public function getCommunityByID($id): Community{
        $sql = "SELECT * FROM community WHERE id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $community = new Community();
            $community->setCommunityID($row['c_id']);
            $community->setCommunityName($row['c_name']);
            $community->setCommunityDescription($row['c_description']);
            $community->setCommunityCreateDate($row['c_create_date']);
            return $community;
        } else {
            return null;
        }
    }

    public function getCommunityByName($name): Community{
        $sql = "SELECT * FROM community WHERE name = $name";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $community = new Community();
            $community->setCommunityID($row['c_id']);
            $community->setCommunityName($row['c_name']);
            $community->setCommunityDescription($row['c_description']);
            $community->setCommunityCreateDate($row['c_create_date']);
            return $community;
        } else {
            return null;
        }
    }

    public function getCommunityByLast($user): Community{
        $sql = "SELECT * FROM community WHERE c_create_date = (SELECT MAX(c_create_date) FROM community WHERE u_id = $user->getId())";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $community = new Community();
            $community->setCommunityID($row['c_id']);
            $community->setCommunityName($row['c_name']);
            $community->setCommunityDescription($row['c_description']);
            $community->setCommunityCreateDate($row['c_create_date']);
            return $community;
        } else {
            return null;
        }
    }

    public function createCommunity($name, $description, $user): bool {
        $sql = "INSERT INTO community (c_name, c_description, u_id) VALUES ('$name', '$description', $user->getId())";
        return $this->query($sql);
    }

    public function addenrollkey($community, $enrollkey): bool {
        $sql = "INSERT INTO community_enroll (c_id, ce_enrollkey) VALUES ('$community->getCommunityID()', '$enrollkey')";
        return $this->query($sql);
    }

    public function addtag($community, $tag): bool {
        foreach ($tag as $t) {
            $sql = "INSERT INTO community_tag (c_id, t_id) VALUES ('$community->getID()', '$t->getID()')";
            if (!$this->query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function adduser($community, $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('$community->getID()', '$user->getId()', 'Member')";
        return $this->query($sql);
    }

    public function editCommunity($community, $name, $description): bool {
        $sql = "UPDATE community SET c_name = '$name', c_description = '$description' WHERE c_id = $community->getCommunityID()";
        return $this->query($sql);
    }

    private function deletetag($community): bool {
        $sql = "DELETE FROM community_tag WHERE c_id = $community->getID()";
        return $this->query($sql);
    }

    public function edittag($community, $tag): bool {
        $this->deletetag($community);
        $sql = "INSERT INTO community_tag (c_id, t_id) VALUES ('$community->getID()', '$tag->getID()')";
        return $this->query($sql);
    }

    public function removeuser($community, $user): bool {
        $sql = "DELETE FROM community_user WHERE c_id = $community->getID() AND u_id = $user->getId()";
        return $this->query($sql);
    }

    public function deleteCommunity($community): bool {
        $sql = "DELETE FROM community WHERE c_id = $community->getCommunityID()";
        return $this->query($sql);
    }

    public function insertsubOwner($community, $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('$community->getCommunityID()', '$user->getId()', 'SubOwner')";
        return $this->query($sql);
    }

    public function insertOwner($community, $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('$community->getCommunityID()', '$user->getId()', 'Owner')";
        return $this->query($sql);
    }
}
?>