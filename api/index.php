<?php
// To display errors at client in preview
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Include CORS headers 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Include database config
include "./config/database.php";
$dataBase = new DbConnect;
$connection = $dataBase->connect();

// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];
// swicht to to distinguish the request type
switch($method){
    case "POST":
        // get data from req
        $task = json_decode(file_get_contents('php://input'));
        // syntax for writing in DB
        $sql = "INSERT INTO Task(id, title, description, status) VALUES(null, :title, :description, :status)";
        $stmt = $connection->prepare($sql);
        // link values to table columns
        $stmt->bindParam(':title', $task->title);
        $stmt->bindParam(':description', $task->description);
        $stmt->bindParam(':status', $task->status);
        if($stmt->execute()){
            // Fetch the newly created task's ID from the database
            $lastInsertedId = $connection->lastInsertId();
            
            // Retrieve the created task using the ID
            $sql = "SELECT id, title, description, status FROM Task WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':id', $lastInsertedId);
            $stmt->execute();
            $createdTask = $stmt->fetch(PDO::FETCH_ASSOC);

            $response = ['status'=>200,'task' => $createdTask ];
        } else{
            $response = ['status'=>500,'message' => 'Failed to create task' ];
        }
        // send res
        echo json_encode($response);
        break;
    case "GET":
        // syntax for select all items
        $sql = "SELECT * FROM Task";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
        break;

    case "PUT":
        $updatedTask = json_decode(file_get_contents('php://input'));
        // syntax for edit items
        $sql = "UPDATE Task SET title = :title, description = :description, status = :status WHERE id = :id";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        // in this if we change the task status if the path in the URL include editStatus
        if(isset($path[4]) && $path[4]=="editStatus"){
            if(isset($path[3]) && is_numeric($path[3])){
                $stmt = $connection->prepare($sql);
                $stmt->bindParam(':title', $updatedTask->title);
                $stmt->bindParam(':description', $updatedTask->description);
                $stmt->bindParam(':status', $updatedTask->status);
                $stmt->bindParam(':id', $updatedTask->id);
                if($stmt->execute()){
                    $response = ['status'=>200,'message' => 'Status updated successfully' ];
                } else{
                    $response = ['status'=>500,'message' => 'Failed to update task status' ];
                };
            };
        } else{
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':title', $updatedTask->title);
            $stmt->bindParam(':description', $updatedTask->description);
            $stmt->bindParam(':status', $updatedTask->status);
            $stmt->bindParam(':id', $updatedTask->id);
            if($stmt->execute()){
                $response = ['status'=>200,'message' => 'Task updated successfully' ];
            } else{
                $response = ['status'=>500,'message' => 'Failed to update task' ];
            }
        }
        echo json_encode($response);
        break;

    case "DELETE":
        // get the id from URL
        $taskId = $_GET['id'];
        // syntax for delete items
        $sql = "DELETE FROM Task WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $taskId);
        if($stmt->execute()){
            $response = ['status'=>200,'message' => 'Task deleted successfully' ];
        } else{
            $response = ['status'=>500,'message' => 'Failed to delete task' ];
        }
        echo json_encode($response);
        break;
    default:
        $response = ['status'=>405,'message' => 'Method Not Allowed' ];
        echo json_encode($response);
        break;
    }
