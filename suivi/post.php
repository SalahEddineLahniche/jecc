<?php
if ($_POST['pnew']) {
    $post['user_id'] = $_POST['user_id'];
    $post['ptext'] = $_POST['ptext'];
    $post['plink'] = $_POST['plink'];
    $post['departement_id'] = $_POST['departement_id'];
    $post['pdate'] = $_POST['pdate'];
    require 'functions.php';
    add_post($post);
}

if ($_POST['get']) {
    $start = $_POST['current'];
    $length = $_POST['length'];
    $departement_id = $_POST['departement_id'];
    require 'functions.php';
    $posts = get_posts($departement_id, $start, $length);
    echo json_encode($posts);
}