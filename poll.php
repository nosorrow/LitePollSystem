<?php
require_once 'src/vendor/autoload.php';

//include_once 'src/bootstrap_app.php';
/* инстанция на класа за анкети => new Polls($id);
 * където id e номера на анкетата в БД.
 *
 * $pollObj = new Polls(2);
*/
use App\Polls;
$pollObject = new Polls(1);
// въпроса на анкетата
$pollSubject = $pollObject->getPollSubject();
// масив с отговори
$polls = $pollObject->FetchPollAnswers();
// масив с резултите
$votes = $pollObject->getResults();
// тотал на гласувалите за изчисляване на процента
$total = (array_sum(array_column($votes, 'count_vote')));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Poll - Title</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .row {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">

    <form action="http://localhost/PollSystem-lite/set-vote.php" method="post">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Анкета</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Q: <?php echo $pollSubject['poll_subject']; ?></h6>
                        <div class="card-body">
                            <input type="hidden" name="pollId" value="<?php echo $pollSubject['id']; ?>">
                            <!-- =========== Показва възможните отговори ===================== =========== -->
                            <?php foreach ($polls as $poll): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="poll-<?php echo $poll['id']; ?>"
                                           name="poll_answer" value="<?php echo $poll['id']; ?>">
                                    <label class="form-check-label" for="poll-<?php echo $poll['id']; ?>">
                                        <?php echo $poll['poll_answer']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            <!-- =========== крей на отговори ===================== =========== -->
                        </div>
                        <div class="col">
                            <input class="card-link btn btn-primary btn-sm" type="submit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>Резултат от анкетата</h4>
                <p>гласове: <?php echo $total; ?></p>
                <?php foreach ($votes as $vote): ?>
                    <?php
                    $percent = round($vote['count_vote'] / $total * 100);; ?>
                    <h6><?php echo $vote['poll_answer']; ?></h6>
                    <div class="progress" style="margin-bottom: 10px" data-toggle="tooltip"
                         data-placement="top" title="<?php echo $vote['count_vote']; ?> гласa">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $percent; ?>%;"
                             aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo $percent; ?>%
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <hr>
    </form>

</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
