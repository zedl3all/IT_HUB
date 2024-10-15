<?php

class AnnouncementAccess implements IAnnouncementAccess{
  private $anmC = new AnnouncementController();
  
  public function createAnm(String $title, String $description, User $anm_userId, Community $communityId, array $anm_tag): Announcement{
    return $this->anmC->createAnnouncement($title, $description, $anm_userId, $communityId, $anm_tag);
  }
  public function deleteAnm(Announcement $an){
    $this->anmC->deleteAnnouncement($an);
  }
  public function getAnms(): array{
    return $this->anmC->getAnnounements();
  }
  public function getAnmById(int $anm_id): Announcement{
    return $this->anmC->getAnnounementById($anm_id);
  }
  public function getAnmsByCommunity(int $communityId): array{
    return $this->anmC->getAnnounementByCommunity($communityId);
  }
  public function insertToCommu(array $anm, Community $community){
    $community->setAnnouncement($anm);
  }
}

?>