<?php
require_once('dbcon.php');

// Tạo kết nối một lần và sử dụng lại
function getConnection() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
    }
    return $conn;
}

$con = getConnection();

function execute($sql) {
    $con = getConnection();
    try {
        $result = $con->query($sql);
        if (!$result) {
            throw new Exception("Lỗi SQL: " . $con->error);
        }
        return $result;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function executeResult($sql) {
    $con = getConnection();
    try {
        $result = $con->query($sql);
        if (!$result) {
            throw new Exception("Lỗi SQL: " . $con->error);
        }
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }
}

function executeSingleResult($sql) {
    $con = getConnection();
    try {
        $result = $con->query($sql);
        if (!$result) {
            throw new Exception("Lỗi SQL: " . $con->error);
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}
