<?php
require_once 'DB.php';

class User extends DB {
    public function register($data) {
        $sql = "INSERT INTO users (username, password, name, email, address, age, gender, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('ssssssss', $data['username'], password_hash($data['password'], PASSWORD_BCRYPT), $data['name'], $data['email'], $data['address'], $data['age'], $data['gender'], $data['phone_number']);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
?>
