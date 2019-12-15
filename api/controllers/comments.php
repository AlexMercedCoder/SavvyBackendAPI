<?php

function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";
}
cors();
header("Content-Type: application/json");
// header("Access-Control-Allow-Headers: Content-Type");

include_once '../models/comments.php';

if ($_REQUEST['action'] === 'index'){

    echo json_encode(Comments::all());

}


else if ($_REQUEST['action'] === 'query'){

    echo json_encode(Comments::some($_REQUEST['restid']));

}


else if ($_REQUEST['action'] === 'post'){

    $request_body = file_get_contents('php://input');
    var_dump($request_body);
    $body_object = json_decode($request_body);
    var_dump($body_object);
    $new_comment = new Comment(null, $body_object->restid,$body_object->author,$body_object->comment,$body_object->password,$body_object->date);
    $all_comments = Comments::create($new_comment); //store the return value of People::create into a var

    //send the return value of People::create (all people in the db) back to the user
    echo json_encode($all_comments);
}


else if ($_REQUEST['action'] === 'update'){

    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_comment = new Comment($_REQUEST['id'], $body_object->restid, $body_object->author,$body_object->comment,$body_object->password,$body_object->date);
    $all_comments = Comments::update($updated_comment);

    echo json_encode($all_comments);
}


else if ($_REQUEST['action'] === 'delete'){

    $all_comments = Comments::delete($_REQUEST['id']);
    echo json_encode($all_comments);
}


?>
