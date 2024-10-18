<?php

require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

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

    public function getCommunityByID(int $id){
        $sql = "SELECT * FROM community WHERE c_id = $id";
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

    public function getCommunityByName(string $name){
        $sql = "SELECT * FROM community WHERE c_name = '{$name}'";
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

    public function getCommunityByLast(User $user){
        $sql = "SELECT * FROM community WHERE c_create_date = (SELECT MAX(c_create_date) FROM community WHERE u_id = {$user->getUserID()})";
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

    public function createCommunity(string $name, string $description, User $user): bool {
        $sql = "INSERT INTO community (c_name, c_description, u_id) VALUES ('$name', '$description', {$user->getUserID()})";
        return $this->query($sql);
    }

    public function addenrollkey(Community $community, string $enrollkey): bool {
        $sql = "INSERT INTO community_enroll (c_id, ce_enrollkey) VALUES ('{$community->getCommunityID()}', '$enrollkey')";
        return $this->query($sql);
    }

    public function getenrollkey(Community $community): string {
        $sql = "SELECT ce_enrollkey FROM community_enroll WHERE c_id = {$community->getCommunityID()}";
        return $this->query($sql);
    }

    public function addtag(Community $community, array $tags): bool {
        foreach ($tags as $t) {
            $sql = "INSERT INTO community_tag (c_id, t_id) VALUES ('{$community->getCommunityID()}', '{$t->getTagID()}')";
            if (!$this->query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function adduser(Community $community, User $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('{$community->getCommunityID()}', '{$user->getUserID()}', 'Member')";
        return $this->query($sql);
    }

    public function editCommunity(Community $community, string $name, string $description): bool {
        $sql = "UPDATE community SET c_name = '$name', c_description = '$description' WHERE c_id = {$community->getCommunityID()}";
        return $this->query($sql);
    }

    private function deletetag(Community $community): bool {
        $sql = "DELETE FROM community_tag WHERE c_id = {$community->getCommunityID()}";
        return $this->query($sql);
    }

    public function edittag(Community $community, array $tag): bool {
        $this->deletetag($community);
        return $this->addtag($community, $tag);
    }

    public function removeuser(Community $community, User $user): bool {
        $sql = "DELETE FROM community_user WHERE c_id = {$community->getCommunityID()} AND u_id = {$user->getUserID()}";
        return $this->query($sql);
    }

    public function deleteCommunity(Community $community): bool {
        $sql = "DELETE FROM community WHERE c_id = {$community->getCommunityID()}";
        return $this->query($sql);
    }

    public function insertsubOwner(Community $community, User $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('{$community->getCommunityID()}', {$user->getUserID()}, 'SubOwner')";
        return $this->query($sql);
    }

    public function insertOwner(Community $community, User $user): bool {
        $sql = "INSERT INTO community_user (c_id, u_id, u_role) VALUES ('{$community->getCommunityID()}', {$user->getUserID()}, 'Owner')";
        return $this->query($sql);
    }

    public function getJoinedCommunities(User $user): array {
        $sql = "SELECT * FROM community WHERE c_id IN (SELECT c_id FROM community_user WHERE u_id = {$user->getUserID()})";
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

    public function getUnJoinedCommunities(User $user): array {
        $sql = "SELECT * FROM community WHERE c_id NOT IN (SELECT c_id FROM community_user WHERE u_id = {$user->getUserID()})";
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

    public function getUserInCommunity(Community $community): array {
        $sql = "SELECT * FROM user WHERE u_id IN (SELECT u_id FROM community_user WHERE c_id = {$community->getCommunityID()})";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $users = [];
            while($row = $result->fetch_assoc()) {
                $user = new User();
                $user->setUserID($row['u_id']);
                $user->setFirstname($row['u_name']);
                $user->setLastname($row['u_lastname']);
                $user->setUserName($row['u_username']);
                $user->setEmail($row['u_email']);
                $user->setCreatedate($row['u_create_date']);
                $users[] = $user;
            }
            return $users;
        } else {
            return [];
        }
    }
}
?>