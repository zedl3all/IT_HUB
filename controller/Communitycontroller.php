<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

class CommunityController {
    private $sqlcommu;
    private $announcesql;
    private $user;
    private $usersql;
    private $commupage;
    private $community;
    private $c_id;
    private $tagsql;

    public function __construct() {
        $this->sqlcommu = new Community_Sql_Controller();
        $this->announcesql = new Announcement_Sql_Controller();
        $this->usersql = new User_Sql_Controller();
        $this->tagsql = new Tag_Sql_Controller();
        ob_start();
        session_start();
        if ((count($_GET) === 5) && !(isset($_GET['ta_id']))){
            if ((isset($_GET['communityName'])) && isset($_GET['enrollKey']) && isset($_GET['customTag']) && isset($_GET['description']) && isset($_GET['u_id'])){
                if (is_null($this->sqlcommu->getCommunityByName($_GET['communityName'])) == 1){
                    $this->community = $this->create_commu($_GET['communityName'], $_GET['enrollKey'], $_GET['description'], $this->usersql->getUserByID($_GET['u_id']), explode("%2C+", $_GET['customTag']));
                    header('Location: '.$_SERVER['PHP_SELF']."?c_id=".$this->c_id."&u_id=".$_GET['u_id']."");
                }
                else{
                    header('Location: '."Join_Leave_Controller.php?create=1");
                }
            }
        }
        else if ((isset($_GET['c_id'])) && !(isset($_GET['ta_id']))){ 
            $_SESSION['an_c'] = $_GET['c_id'];
            
            $c_id = $_GET['c_id'];
            $this->community = $this->sqlcommu->getCommunityByID($c_id);

            // Use $community_id to fetch community details, for example from the database.
        } else if ((isset($_GET['ta_id'])) && (isset($_GET['c_id']))){
            $c_id = $_GET['c_id'];
            $ta_id = $_GET['ta_id'];
            $this->community = $this->sqlcommu->getCommunityByID($c_id);
            $ta = $this->usersql->getUserByID($ta_id);
            $this->insertSubOwner($this->community, $ta);
        } else {
            // Handle the case where community_id is not provided
            echo "Community ID not found!";
        }
        
        if (isset($_GET['u_id'])) {
            $_SESSION['an_u'] = $_GET['u_id'];
            $u_id = $_GET['u_id'];
            $this->user = $this->usersql->getUserByID($u_id);

            // Use $community_id to fetch User details, for example from the database.
        } else {
            // Handle the case where community_id is not provided
            echo "User ID not found!";
        }

        $announcements = $this->announcesql->getAnnouncementsByCommunity($this->community->getCommunityID($_GET['c_id']));

        $this->commupage = new CommunityPage();
        $this->commupage->setUser($this->user);
        $this->commupage->setAnnouncements($announcements);
        $this->commupage->setCommunity($this->community);
    }

    public function create_commu(String $name, String $enroll, String $description, User $owner, array $tag): Community {
        $tag = explode(",", $tag[0]);
        //echo $tag[0];
        $tags = [];
        foreach($tag as $t){
            $tagData = $this->tagsql->getTagByName(trim($t));
            
            if($tagData == null){
                //echo "create";
                $this->tagsql->createTag(trim($t), trim($t));
                $tags[] = $this->tagsql->getTagByName(trim($t));
            }else{
                //echo "not create";
                $tags[] = $tagData;
            }
        }
        $this->sqlcommu->createCommunity($name, $description, $owner);
        $community = $this->sqlcommu->getCommunityByName($name);
        $this->sqlcommu->addtag($community, $tags);
        $this->sqlcommu->addenrollkey($community, $enroll);
        $this->sqlcommu->insertOwner($community, $owner);
        
        header("Location: " . $_SERVER['PHP_SELF']."?c_id=".$community->getCommunityID()."&u_id=".$owner->getUserID()."");
        exit();
        return $community;
    }

    public function delete_commu(Community $community) {
        $this->sqlcommu->deleteCommunity($community);
    }

    public function edit_commu(Community $community, String $name, String $description, array $tag) {
        $community->setCommunityName($name);
        $community->setCommunityDescription($description);
        $community->setTag($tag);
        $this->sqlcommu->editCommunity($community, $name, $description);
        $this->sqlcommu->edittag($community, $tag);
    }

    public function insertSubOwner(Community $community, User $subowner) {
        if ($this->sqlcommu->getRoleByUser($community, $subowner) == "Member"){
            $this->sqlcommu->updatesubOwner($community, $subowner);
        } else {
            $this->sqlcommu->insertsubOwner($community, $subowner);
        }
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
    public function getTagsql(){
        return $this->tagsql;
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
