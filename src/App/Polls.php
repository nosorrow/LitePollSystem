<?php

namespace App;

use Adapter\Database;

/**
 * Class Polls
 */
class Polls extends AppClass
{
    /**
     * инстанция на pdo обекта с БД
     * @var mixed
     */
    public $db;

    /**
     *  Id на анкетата в БД
     * @var
     */
    private $poll_id;

    /**
     * Polls constructor.
     */
    public function __construct($poll_id)
    {
        parent::__construct();

        Database::setInstance(DBHOST, DBUSER, DBPASS, DBNAME);

        $this->db = Database::getInstance();
        $this->poll_id = $poll_id;
        $this->request->session->store('test', 'is a Test');
    }

    /**
     * Връща масив с отговорите на анкетата
     * @return mixed
     */
    public function FetchPollAnswers()
    {
        try {
            $sql = " SELECT * FROM `tbl_poll_answers` WHERE poll_id = ?";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([$this->poll_id]);

            return $stmt->fetchAll();

        } catch (\PDOException $e) {

            echo $e->getMessage();
            die();
        }
    }

    /**
     * Въпроса на анкетата
     * @return mixed
     */
    public function getPollSubject()
    {
        try {
            $sql = " SELECT * FROM `tbl_polls` WHERE id = ?";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([$this->poll_id]);

            return $stmt->fetch();

        } catch (\PDOException $e) {

            echo $e->getMessage();
            die();
        }
    }

    /**
     * Запис на гласуването
     * @param $poll_answer_id
     * @return bool
     */
    public function setPollVote($poll_answer_id, $user = '')
    {

        $sql = "INSERT INTO `tbl_poll_votes` (`poll_id`, `poll_answer_id`, `poll_vote`, `poll_user`) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if ($stmt->execute([$this->poll_id, $poll_answer_id, 1, $user])) {

           return true;
        }

    }


    /**
     * @return mixed
     */
    public function getResults()
    {
        $sql = "
            SELECT tbl_poll_answers.poll_answer, 
            COUNT(tbl_poll_votes.poll_vote) as count_vote 
            FROM tbl_poll_answers JOIN tbl_poll_votes ON tbl_poll_answers.id = tbl_poll_votes.poll_answer_id 
            WHERE tbl_poll_votes.poll_id = ?
            GROUP BY tbl_poll_answers.poll_answer
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$this->poll_id]);

        return $stmt->fetchAll();

    }

    /**
     * Участвал ли е потребителя в анкетата
     * @param $user
     * @return bool
     */
    public function hasUserVote($user)
    {
        $sql = "SELECT count(*) as count_vote FROM `tbl_poll_votes` 
                WHERE poll_user = ? AND poll_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user, $this->poll_id]);

        return (bool)$stmt->fetch(\PDO::FETCH_COLUMN);
    }
}

