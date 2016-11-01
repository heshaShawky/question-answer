<?php
/**
 * Created By: Hisham Shawky
 * Email: me@heshamshawky.com
 */

// Require Config
require_once  $_SERVER['DOCUMENT_ROOT'] . '/answers/inc/config.php';

// Check if the id is empty
if (empty($_GET['id']))
    header("Location:".BASE_URL."");

// Get header
include ROOT_BATH . '/template-parts/header.php';

// Check if the id isset
if (isset($_GET['id'])) {
    $lessons = read_lessons($_GET['id']);
    $lesson_num = 1;
} else
    header("Location:".BASE_URL."");

?>

<div class="container">
    <main class="col-sm-8" id="main" role="main">
        <section class="lessons">
            <h2>الدروس الحالية: </h2>
        </section>
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>رقم الدرس</th>
                    <th>عنوان الدرس</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($lessons as $lesson) :
                    $lesson_title   = $lesson['title'];
                    $lesson_id      = intval($lesson['id']);
                    $lesson_url     = BASE_URL."/lessons.php?id={$lesson_id}&lesson_name=".urlencode($lesson_title);

                ?>
                    <tr>
                        <td class="text-center"><h4><?php echo $lesson_num++ ?></h4></td>
                        <td><a href="<?php echo $lesson_url ?>"><h4><?php echo $lesson_title?></h4></a></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <aside id="sidbar" role="sidebar">

    </aside>
</div>


<?php // Get Footer
include ROOT_BATH . '/template-parts/footer.php';