<?php
class Announcement{
    private int $anm_id;
    private string $title;
    private string $description;
    private string $dateCreate;
    private array $anm_tag = [];
    private int $anm_userId = 0;
    private int $communityId = 0;
    public function setAnnouncementID(int $anm_id){
        $this->anm_id = $anm_id;
    }
    public function getAnnouncementID(): int{
        return $this->anm_id;
    }
    public function setAnnouncementTitle(string $title){
        $this->title = $title;
    }
    public function getAnnouncementTitle(): string{
        return $this->title;
    }
    public function setAnnouncementDescription(string $description){
        $this->description = $description;
    }
    public function getAnnouncementDescription(): string{
        return $this->description;
    }
    public function setAnnouncementCreateDate(string $dateCreate){
        $this->dateCreate = $dateCreate;
    }
    public function getAnnouncementCreateDate(): string{
        return $this->dateCreate;
    }
    public function setAnnouncementTag(array $anm_tag){
        $this->anm_tag = $anm_tag;
    }
    public function getAnnouncementTag(): array{
        return $this->anm_tag;
    }
    public function setAnnouncementUserId(int $anm_userId){
        $this->anm_userId = $anm_userId;
    }
    public function getAnnouncementUserId(): int{
        return $this->anm_userId;
    }
    public function setAnnouncementCommunityId(int $communityId){
        $this->communityId = $communityId;
    }
    public function getAnnouncementCommunityId(): int{
        return $this->communityId;
    }
}
?>
