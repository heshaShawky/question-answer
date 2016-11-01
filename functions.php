<?php
/**
 * Created By: Hisham Shawky
 * Email: me@heshamshawky.com
 */

// Create Categories
function insert_categories($category) {
    global $con;
    try {
        $results = $con->prepare("
            INSERT INTO categories (name) VALUE (?)
        ");
        $results->bindParam(1, $category);
        $results->execute();
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results;
}

// Read Categories
function read_categories() {
    global $con;
    try {
        $results = $con->prepare("
            SELECT * FROM categories
        ");
        $results->execute();
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results->fetchAll(PDO::FETCH_ASSOC);
}

// Create Lessons
function insert_lessons($lesson_title, $cat_id) {
    global $con;
    try {
        $results = $con->prepare("
            INSERT INTO lessons (title, cat_id) VALUES (?, ?)
        ");
        $results->execute(array($lesson_title, $cat_id, $cat_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results;
}

// Read Lessons
function read_lessons($cat_id) {
    global $con;
    try {
        $results = $con->prepare("
            SELECT * FROM lessons
            WHERE cat_id = ?
        ");
        $results->execute(array($cat_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results->fetchAll(PDO::FETCH_ASSOC);
}


// Create Questions
function insert_questions($title, $content, $lesson_id) {
    global $con;
    try {
        $results = $con->prepare("
            INSERT INTO questions (title, content, lesson_id) VALUES (?, ?, ?)
        ");
        $results->execute(array($title, $content, $lesson_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results;
}

// Read Questions
function read_questions($lesson_id) {
    global $con;
    try {
        $results = $con->prepare("
            SELECT * FROM questions
            WHERE lesson_id = ?
        ");
        $results->execute(array($lesson_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results->fetchAll(PDO::FETCH_ASSOC);
}

// Read Question
function read_question($question_id)
{
    global $con;
    try {
        $results = $con->prepare("
            SELECT * FROM questions
            WHERE id = ?
        ");
        $results->execute(array($question_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results->fetchAll(PDO::FETCH_ASSOC);
}

// Create Answers
function insert_answers($name, $content, $question_id) {
    global $con;
    try {
        $results = $con->prepare("
            INSERT INTO answers (user_name, content, question_id) VALUES (?, ?, ?)
        ");
        $results->execute(array($name, $content, $question_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results;
}

// Read Answers
function read_answers($question_id) {
    global $con;
    try {
        $results = $con->prepare("
            SELECT * FROM answers
            WHERE question_id = ?
        ");
        $results->execute(array($question_id));
    } catch (Exception $e) {
        echo "ERROR! " . $e->getMessage() . "<br />";
        die();
    }
    return $results->fetchAll(PDO::FETCH_ASSOC);
}