<?php 
require_once '../project/announcementBuilder.php';
require_once '../project/announcement.php';
class AnnouncementDirector{
  private $AnBuilder;
  function __construct(AnnouncementBuilder $AnBuilder){
    $this->AnBuilder = $AnBuilder;
  }
  public function constructAnnouncement(int $idAn, string $header, string $detail, string $dateCreate, array $tagAn, int $userAn): Announcement{
    return $this->AnBuilder
                ->setIdAn($idAn)
                ->setHeader($header)
                ->setDetail($detail)
                ->setDateCreate($dateCreate)
                ->setTagAn($tagAn)
                ->setUserAn($userAn)
                ->build();
  }
}

?>