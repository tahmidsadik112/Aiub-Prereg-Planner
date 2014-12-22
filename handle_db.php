<?php
$search_title = (isset($_GET['title']) ? $_GET['title'] : null);

if($search_title !== null) {
    header('Content-type: application/json');
    $m = new MongoClient();
    $db = $m->selectDB("prereg");
    $collection = $db->selectCollection("subjects");

    $where = array('title' => array('$regex' => new MongoRegex("/^$search_title/i")));
    $cursor = $collection->find($where);
    $data = iterator_to_array($cursor);

//creating the response

    echo json_encode($data);

}
exit();