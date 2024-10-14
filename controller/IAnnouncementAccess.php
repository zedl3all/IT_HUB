<?php

interface IAnnouncementAccess{
  public function createAnm(String $title, String $description, User $anm_userId, Community $communityId, array $anm_tag): Announcement;
  public function deleteAnm(Announcement $an);
  public function getAnms(): array;
  public function getAnmById(int $anm_id): Announcement;
  public function getAnmsByCommunity(int $communityId): array;
}

?>