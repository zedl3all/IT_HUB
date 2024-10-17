<?php
interface IQuestionAccess{
    public function createQuestion($user, $commu, $q_id, $header, $desciption);
    public function deleteQuestion($question);
    public function createAnswer($text, $mode, $question, $user);
    public function deleteAnswer($answer);
}
?>