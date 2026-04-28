<?php
include("./database.php");
include("./includes/functions.inc.php");

if (isset($_POST['btnsubmit'])) {
    $action = $_POST['btnsubmit'];
    if ($action == "Login") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $data = "All Fields are Required";
        } else if (strlen($password) < 8) {
            $data = "Password must be at least 8 characters";
        } else if (strlen($password) > 8) {
            $userData = getUserData($conn, "", $username, $password);
            if (count($userData) > 0) {
                $newPassword = md5($password);
                if ($newPassword == $userData[0]['paswword']) {
                    $data = "Login Successful";
                } else {
                    $data = "Invalid Login Details";
                }
            } else {
                $data = "User not registered, kindly register first";
            }
        } else {
            $data = "Invalid Post Request";
        }
        echo json_encode($data);
    }

}
