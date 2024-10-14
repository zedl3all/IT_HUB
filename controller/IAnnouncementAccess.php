<?php

interface IAnnouncementAccess{
  public function createAnm(String $title, String $description, User $anm_userId, Community $communityId, array $anm_tag);
  public function deleteAnm(Announcement $an);
  public function getAnm($anm_id): Announcement;
}

?>