<?php

interface AnnouncementBuilder {
  public function setIdAn(int $idAn): AnnouncementBuilder;
  public function setHeader(string $header): AnnouncementBuilder;
  public function setDetail(string $detail): AnnouncementBuilder;
  public function setDateCreate(string $dateCreate): AnnouncementBuilder;
  public function setTagAn(array $tagAn): AnnouncementBuilder;
  public function setUserAn(int $userAn): AnnouncementBuilder;
  public function build(): Announcement;
}

?>