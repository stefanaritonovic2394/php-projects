<?php

//    require_once 'classes/Connection.php';
//    include '../includes/autoload.php';

    class User
    {
        private $db;

        public function __construct($conn)
        {
            $this->db = $conn;
        }

        public function register($uname, $umail, $upass)
        {
            try {
                $new_pass = password_hash($upass, PASSWORD_DEFAULT);
                
                $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(:uname, :umail, :upass)");

                $stmt->bindparam(":uname", $uname);
                $stmt->bindparam(":umail", $umail);
                $stmt->bindparam(":upass", $new_pass);
                $stmt->execute();

                return $stmt;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function login($umail, $upass)
        {
            try {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :umail OR password = :upass");
                $stmt->execute(array(':umail' => $umail, ':upass' => $upass));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() == 1) {
                    if (password_verify($upass, $userRow['password'])) {
                        $_SESSION['user_session'] = $userRow['id'];
                        return true;
                    } else {
                        return false;
                    }
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function redirect($url)
        {
            header("Location: $url");
        }

        public function is_logged_in()
        {
            if (isset($_SESSION['user_session'])) {
                return true;
            }
        }

        public function logout()
        {
            session_destroy();
            unset($_SESSION['user_session']);
            return true;
        }
    }
