<?php

//include_once 'src/bootstrap_app.php';
require_once 'src/vendor/autoload.php';

use System as Sys;
use App\Polls;

// обектът Request държи и нормализира глобалните $_POST & $_GET
$request = Sys\Request::getInstance();

// нормализиран  => $_POST['pollId'] и $_POST['poll_answer']
$id = $request->post('pollId', 'int');
$answerId = $request->post('poll_answer', 'int');

/* == Искаме потребителя да отговаря само по един път
     $user може да го вземе от сесията на регистриран потребител примерно == */

$user = "dummies-2";

//================ Записваме  =================================
if ($id && $answerId) {

    $pollObject = new Polls($id);

    /* Разкоментирай за проверка на потребител */

    // участвал == true ; не е участвал == false

   //  if ($pollObject->hasUserVote($user) === false) {

    /* Записва отговора и връща true */
    $set = $pollObject->setPollVote($answerId, $user);

    // въпроса на анкетата
    $pollSubject = $pollObject->getPollSubject();

    // масив с резултатите
    $votes = $pollObject->getResults();
    // тотал на гласувалите за изчисляване на процента
    $total = (array_sum(array_column($votes, 'count_vote')));

    /* } else {
         die('Вече сте участвали в анкетата!');
      }*/

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Title</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php if ($set === true): ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    Гласувахте успешно !
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <h4>Резултат от анкетата</h4>
                <p>гласове: <?php echo $total;?></p>
                <?php foreach ($votes as $vote): ?>
                    <?php
                    $percent = round($vote['count_vote'] / $total * 100);; ?>
                    <h6><?php echo $vote['poll_answer']; ?></h6>
                    <div class="progress" style="margin-bottom: 10px" data-toggle="tooltip"
                         data-placement="top" title="<?php echo $vote['count_vote'];?> гласa">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percent; ?>%;"
                             aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo $percent; ?>%
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row" style="margin: 20px 0">
            <div class="col-md-6 offset-md-2">
                <button class="btn btn-success" onclick="window.history.back()">Назад</button>
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
