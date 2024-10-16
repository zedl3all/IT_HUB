<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once '../view/CommunityPage/CommunityPage.php'; // Include CommunityPage class

class CommunityController {
    private $sqlcommu;
    private $announcesql;
    private $user;
    private $usersql;
    private $commupage;
    private $community;

    public function __construct() {
        $this->sqlcommu = new Community_Sql_Controller();
        $this->announcesql = new Announcement_Sql_Controller();
        $this->usersql = new User_Sql_Controller();
        ob_start();
        session_start();

        // Handle user session
        if (isset($_SESSION["user_use_now"])) {
            $this->user = $_SESSION["user_use_now"];
        } else {
            $this->user = $this->usersql->getUserByID(1); // Default user ID
            $_SESSION["user_use_now"] = $this->user;
        }

        // Handle community session
        if (isset($_SESSION["community_id"])) {
            $this->community = $_SESSION["community"];
        } else {
            $this->community = $this->sqlcommu->getCommunityByID(8);
            $_SESSION["community"] = $this->community;
        }

        $announcements = $this->announcesql->getAnnouncementsByCommunity($this->community->getCommunityID());

        $this->commupage = new CommunityPage();
        $this->commupage->setUser($this->user);
        $this->commupage->setAnnouncements($announcements);
        $this->commupage->setCommunity($this->community);
    }

    public function create_commu(String $name, String $enroll, String $description, User $owner, Tag $tag): Community {
        $community = new Community();
        $community->setCommunityName($name);
        $community->setCommunityDescription($description);
        $community->setEnroll($enroll);
        $community->setOwner($owner);
        $community->setTag($tag);

        $this->sqlcommu->createCommunity($name, $description, $owner);
        $this->sqlcommu->addenrollkey($community, $enroll);
        $this->sqlcommu->addtag($community, $tag);

        return $community;
    }

    public function delete_commu(Community $community) {
        $this->sqlcommu->deleteCommunity($community);
    }

    public function edit_commu(Community $community, String $name, String $description, Tag $tag) {
        $community->setCommunityName($name);
        $community->setCommunityDescription($description);
        $community->setTag($tag->getTag());
        $this->sqlcommu->editCommunity($community, $name, $description);
        $this->sqlcommu->edittag($community, $tag);
    }

    public function insertSubOwner(Community $community, User $subowner) {
        $tempsub = $community->getSubOwner();
        array_push($tempsub, $subowner);
        $community->setSubOwner($tempsub);
        $this->sqlcommu->insertsubOwner($community, $subowner);
    }

    // Getter and Setter methods
    public function getSqlcommu() {
        return $this->sqlcommu;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getUsersql() {
        return $this->usersql;
    }

    public function setUsersql($usersql) {
        $this->usersql = $usersql;
    }

    public function setSqlcommu($sqlcommu) {
        $this->sqlcommu = $sqlcommu;
    }

    public function getCommupage() {
        return $this->commupage;
    }

    // Method to check user role
    public function checkUserRole() {
        if (isset($_GET["role"])) {
            $_SESSION["user_use_now"] = $this->usersql->getUserByID($_GET["role"]);
            $this->user = $_SESSION["user_use_now"];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit(); // Stop script execution after sending header
        }
    }
}

// Create an instance of the controller and render the CommunityPage
$controller = new CommunityController();
$controller->checkUserRole();
$controller->getCommupage()->render();
ob_end_flush();
?>
