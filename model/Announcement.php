<?php
class Announcement{
    private $idAn;
    private $header;
    private $detail;
    private $dateCreate;
    private $tagAn;
    private $userId;
    private $communityId;
    public function setIdAn(int $idAn){
        $this->idAn = $idAn;
    }
    public function getIdAn(): int{
        return $this->idAn;
    }
    public function setHeader(string $header){
        $this->header = $header;
    }
    public function getHeader(): string{
        return $this->header;
    }
    public function setDetail(string $detail){
        $this->detail = $detail;
    }
    public function getDetail(): string{
        return $this->detail;
    }
    public function setDateCreate(string $dateCreate){
        $this->dateCreate = $dateCreate;
    }
    public function getDateCreate(): string{
        return $this->dateCreate;
    }
    public function setTagAn(array $tagAn){
        $this->tagAn = $tagAn;
    }
    public function getTagAn(): array{
        return $this->tagAn;
    }
    public function setUserId(int $userId){
        $this->userId = $userId;
    }
    public function getUserId(): int{
        return $this->userId;
    }
    public function setCommunityId(int $communityId){
        $this->communityId = $communityId;
    }
    public function getCommunityId(): int{
        return $this->communityId;
    }
}
?>
