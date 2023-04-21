<?php


class User {

    public $id;

    /** Validate all the data in the $_POST[] super global array */
    public function validate() {

        $minLenght = 2;
        $maxLenght = 15;

        if (isset($this->firstname) && $this->firstname == '') {
            $this->errors[] = 'First name is required';
        }

        if (isset($this->lastname) && $this->lastname == '') {
            $this->errors[] = 'Last name is required';
        }

        if (isset($this->username) && $this->username == '') {
            $this->errors[] = 'Username is required';
        }

        if (isset($this->ocupation) && $this->ocupation == '') {
            $this->errors[] = 'Ocupation is required';
        }

        if (isset($this->description) && $this->description == '') {
            $this->errors[] = 'Description is required';
        }

        if (isset($this->email)) {
            if ($this->email == '') {
                $this->errors[] = 'Email is required';
            }
            if (!$this->email == '' && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = 'Email is invalid';
            }
        }

        if (isset($this->password) && $this->password == '') {

            $this->errors[] = 'Password is required';
        } else {
            if (!$this->password == '') {
                if (strlen($this->password) < $minLenght) {
                    $this->errors[] = 'Password should have at least ' . $minLenght . ' characters';
                }
                if (strlen($this->password) > $maxLenght) {
                    $this->errors[] = 'Password should have max ' . $maxLenght . ' characters';
                }
            }
        }

        if (isset($this->newPassword) && isset($this->confirmPassword)) {

            if ($this->newPassword == '') {
                $this->errors[] = 'New password is required';
            } else {
                if (strlen($this->newPassword) < $minLenght) {
                    $this->errors[] = 'Password should have at least ' . $minLenght . ' characters';
                }
                if (strlen($this->newPassword) > $maxLenght) {
                    $this->errors[] = 'Password should have max ' . $maxLenght . ' characters';
                }
            }

            if ($this->confirmPassword == '') {
                $this->errors[] = 'Confirm password is required';
            }

            if (!$this->newPassword == '' && !$this->confirmPassword == '') {

                if ($this->newPassword !== $this->confirmPassword) {
                    $this->errors[] = 'New password and Confirm password do not match';
                }
            }
        }


        return empty($this->errors);
    }

    /** Select user where id matches and return true is succesfull */
    public function authenticateUser($conn) {

        $sql = "SELECT * FROM users WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    /** Insert new user in db with a hashed password */
    public function create($conn) {

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password)
                    VALUES(:username, :password)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    /** Update users, set verified to 1 where the user id matches */
    public function verified($conn, $id) {

        $sql = "UPDATE users SET verified = 1 WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    /** Select user in db where username matches and return the verified password */
    public function authenticateLogin($conn, $password) {

        $sql = "SELECT * FROM users WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();

        if ($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }

    /** Check if the user has verified her account */
    public function checkVerified($conn) {

        $sql = "SELECT * FROM users WHERE username = :username AND verified = 1";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();

        if ($stmt->fetch()) {
            return true;
        }
    }

    /** Update users, set new email and password where id matches */
    public function updateLogin($conn) {

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET email = :email,  password = :password
                    WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    /** Create user profile, set ocupation and description where id matches */
    public function createProfile($conn) {

        $sql = "UPDATE users SET ocupation = :ocupation, description = :description, has_profile = 1
        WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':ocupation', $this->ocupation, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    /** Update users, set ocupation and description where id matches */
    public function updateProfile($conn) {

        $sql = "UPDATE users SET ocupation = :ocupation,  description = :description, has_profile = 1
        WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':ocupation', $this->ocupation, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
    }

    /** * Select user where username matches and return an user object */
    public static function getByUsername($conn, $username, $columns = '*') {

        $sql = "SELECT $columns
                FROM users
                WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        if ($stmt->execute()) {

            return $stmt->fetch();
        }
    }

    /** * Select user where id matches and return an user object */
    public static function getById($conn, $id, $columns = '*') {

        $sql = "SELECT $columns
                FROM users
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        if ($stmt->execute()) {

            return $stmt->fetch();
        }
    }
}
