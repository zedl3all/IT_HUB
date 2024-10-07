<?php 
require_once '../project/announcementBuilder.php';
require_once '../project/announcement.php';

class AnnouncementConcrete implements AnnouncementBuilder {
  private $idAn;
  private $header;
  private $detail;
  private $dateCreate;
  private $tagAn;
  private $userAn;

  public function setIdAn(int $idAn): AnnouncementBuilder{
    $this->idAn = $idAn;
    return $this;
  }
  public function setHeader(string $header): AnnouncementBuilder{
    $this->header = $header;
    return $this;
  }
  public function setDetail(string $detail): AnnouncementBuilder {
    $this->detail = $detail;
    return $this;
  }
  public function setTagAn(array $tagAn): AnnouncementBuilder {
    $this->tagAn = $tagAn;
    return $this;
  }
  public function setDateCreate(string $dateCreate): AnnouncementBuilder {
    $this->dateCreate = $dateCreate;
    return $this;
  }
  public function setUserAn(int $userAn): AnnouncementBuilder {
    $this->userAn = $userAn;
    return $this;
  }
  public function build(): Announcement{
    return new Announcement($this->idAn, $this->header, $this->detail, $this->dateCreate, $this->tagAn, $this->userAn);
  }
}

?>