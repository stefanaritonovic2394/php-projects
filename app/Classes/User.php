<?php

    namespace App\Classes;

    use App\Classes\QueryBuilder;
    use PDO;
    use PDOException;

    class User
    {
        private $db;
        private $queryBuilder;

        public function __construct($conn)
        {
            $this->db = $conn;
            $this->queryBuilder = QueryBuilder::getInstance();
        }

        public function register($uname, $umail, $upass)
        {
            $new_pass = password_hash($upass, PASSWORD_DEFAULT);
//            $queryBuilder = QueryBuilder::getInstance();
            $this->queryBuilder->prepareExecute("INSERT INTO users(name, email, password) VALUES(:uname, :umail, :upass)", ['uname' => $uname, 'umail' => $umail, 'upass' => $new_pass]);
            //return $queryBuilder;

//                $stmt = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(:uname, :umail, :upass)");
//
//                $stmt->bindparam(":uname", $uname);
//                $stmt->bindparam(":umail", $umail);
//                $stmt->bindparam(":upass", $new_pass);
//                $stmt->execute();
//
//                return $stmt;
        }

        public function login($umail, $upass)
        {
            $queryBuilder = QueryBuilder::getInstance();
            $user = $queryBuilder::table("users")->selectAll()->where(['email' => $umail, 'password' => $upass]);
//                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :umail OR password = :upass");
//                $stmt->execute(array(':umail' => $umail, ':upass' => $upass));
//                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            //if ($user->rowCount() == 1) {
                if (password_verify($upass, $user->password)) {
                    $_SESSION['user_session'] = $user['id'];
                    return true;
                } else {
                    return false;
                }
            //}
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
