<?php


header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

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
