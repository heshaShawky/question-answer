<?php
/**
 * Created By: Hisham Shawky
 * Email: me@heshamshawky.com
 */

// Require Config
require_once  $_SERVER['DOCUMENT_ROOT'] . '/answers/inc/config.php';

// Get header
include ROOT_BATH . '/template-parts/header.php';

if (isset($_GET['id']))
    $questions = read_questions($_GET['id']);

else
//    header("Location:".BASE_URL."");

?>

<div class="container">
    <main class="col-sm-8" id="main" role="main">
        <section id="questuins">

            <?php if (isset($_GET['id'])): ?>

                <h2>الأستفسارات المتعلقة بالدرس: <?php echo $_GET['lesson_name']; ?></h2>

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <?php // check if there a question ?>
                    <?php if (count($questions) >= 1): ?>

                        <?php // Looping the questions ?>
                        <?php
                        // Questions order
                        $question_num = 1; ?>
                        <?php foreach ($questions as $question): ?>
                            <?php
                            // Question url
                            $question_url = BASE_URL . "/lessons.php?question_id=".intval($question['id'])."&question={$question['title']}"; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $question_num; ?>" aria-expanded="true" aria-controls="collaps-<?php echo $question_num;?>">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            <?php echo $question['title'] ?>
                                        </a>
                                        <a class="pull-left" href="<?php echo $question_url; ?>">شاهد الأجابات</a>
                                    </h4>
                                </div>
                                <div id="collapse-<?php echo $question_num; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <?php echo $question['content']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php $question_num++ ?>
                        <?php endforeach;?>

                    <?php else:?>

                        <h3>لا توجد اي استفسارات بهذا الدرس</h3>

                    <?php endif;?>
                </div>

            <?php elseif (isset($_GET['question_id'])): ?>
                <?php $questions = read_question($_GET['question_id']); ?>
                <?php foreach ( $questions as $question ): ?>
                    <?php
                    $sql = "SELECT * FROM lessons WHERE id = ?";
                    $results = $con->prepare($sql);
                    $results->execute(array($question['lesson_id']));
                    while ($lesson = $results->fetch(PDO::FETCH_ASSOC))
                        echo "<h2>{$lesson['title']}<hr></h2>";

                    ?>
                    <h3> الأستفسار  <?php echo $question['title']; ?></h3>
                    <p><?php echo $question['content']; ?></p><hr>

                <?php endforeach; ?>
                <h4 class="text-center">ألأجابات المتاحة:  <hr></h4>

                <?php
                $ava_answers = read_answers($_GET['question_id']);
                if (count($ava_answers) > 0) {
                    foreach ($ava_answers as $answer)
                        echo "<h4>{$answer['user_name']}</h4><p>{$answer['content']}</p><hr>" ;
                }
                else
                    echo "<h4>لا توجد إجابات</h4>";
                ?>

                <h4>ضع أجابتم هنا :</h4>
                
                <?php if (isset($_POST['submit'])):
                        $put_answer = insert_answers($_POST['username'], $_POST['answer'], $_GET['question_id']);
                 $question_url = BASE_URL . "/lessons.php?question_id=".intval($question['id'])."&question={$question['title']}";

                        header("Location:{$question_url}");
                endif;?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username"> الأسم:*</label>
                        <input class="form-control" name="username" placeholder="ضع أسمك هنا..." required>
                    </div>
                    <div class="form-group">
                        <label for="answer">الأجابة:*</label>
                        <textarea class="form-control" placeholder="ضع أجابتك هنا..." name="answer" style="max-width: 100%;min-width: 100%" required></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default" type="submit" name="submit" value="إرسال">
                    </div>
                </form>

            <?php endif;?>
        </section><!-- //#questions -->
    </main><!-- //#main -->
</div><!-- //.container -->


<?php // Get Footer
include ROOT_BATH . '/template-parts/footer.php';