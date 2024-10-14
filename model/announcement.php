<?php
class Announcement{
    private $idAn;
    private $header;
    private $detail;
    private $dateCreate;
    private $tagAn;
    private $userAn;
    function __construct(int $idAn, string $header, string $detail, string $dateCreate, array $tagAn, int $userAn){
        $this->idAn = $idAn;
        $this->header = $header;
        $this->detail = $detail;
        $this->dateCreate = $dateCreate;
        $this->tagAn = $tagAn;
        $this->userAn = $userAn;
    }
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
    public function setUserAn(int $userAn){
        $this->userAn = $userAn;
    }
    public function getUserAn(): int{
        return $this->userAn;
    }
}
?>