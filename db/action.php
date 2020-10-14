<?php

    $connect = new PDO("mysql:host=localhost;dbname=crud", "root", "");
    $received_data = json_decode(file_get_contents("php://input"));
    $data = array();

    if($received_data->action == 'fetchall') {
        $query = "SELECT * FROM user ORDER BY id DESC";

        $statement = $connect->prepare($query);
        $statement->execute();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        echo json_encode($data);
    }

    if($received_data->action == 'insert') {
        $data = array(
        ':first_name' => $received_data->firstName,
        ':last_name' => $received_data->lastName,
        ':email' => $received_data->email,
        ':phone' => $received_data->phone
        );

        $query = "INSERT INTO user (first_name, last_name, email, phone) VALUES (:first_name, :last_name, :email, :phone)";

        $statement = $connect->prepare($query);
        $statement->execute($data);

        $output = array( 
        'message' => 'Data Inserted'
        );

        echo json_encode($output);
    }

    if($received_data->action == 'fetchSingle') {
        $query = "SELECT * FROM user WHERE id = '".$received_data->id."'";

        $statement = $connect->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();

        foreach($result as $row) {
            $data['id'] = $row['id'];
            $data['first_name'] = $row['first_name'];
            $data['last_name'] = $row['last_name'];
            $data['email'] = $row['email'];
            $data['phone'] = $row['phone'];
        }

        echo json_encode($data);
    }

    if($received_data->action == 'update') {
        $data = array(
        ':first_name' => $received_data->firstName,
        ':last_name' => $received_data->lastName,
        ':email' => $received_data->email,
        ':phone' => $received_data->phone,
        ':id'   => $received_data->hiddenId
        );

        $query = "UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone WHERE id = :id";

        $statement = $connect->prepare($query);
        $statement->execute($data);

        $output = array(
        'message' => 'Data Updated'
        );

        echo json_encode($output);
    }

    if($received_data->action == 'delete') {
        $query = "DELETE FROM user WHERE id = '".$received_data->id."'";

        $statement = $connect->prepare($query);
        $statement->execute();

        $output = array(
        'message' => 'Data Deleted'
        );

        echo json_encode($output);
    }
?>
