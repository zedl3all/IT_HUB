<?php
class QuestionAccess implements IQuestionAccess{
    private $qcontrol;
    public function createQuestion($user, $commu, $q_id, $header, $desciption){
        $this->qcontrol->createQuestion($user, $commu, $q_id, $header, $desciption);
    }
    public function deleteQuestion($question){
        $this->qcontrol->deleteQuestion($question);
    }
    public function createAnswer($text, $mode, $question, $user){
        $this->qcontrol->createAnswer($text, $mode, $question, $user);
    }
    public function deleteAnswer($answer){
        $this->qcontrol->deleteAnswer($answer);
    }
}
?>