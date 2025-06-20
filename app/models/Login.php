<?php
class Login extends Dbh
{
    public function getUser($email, $password)
    {
        $sql = "SELECT * FROM customers WHERE email = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            header("location: ../../?error=LoginFailed");
            exit();
        }
        if (!password_verify($password, $user["password"])) {
            header("location: ../../?error=LoginFailed");
            exit();
        };

        return $user;
    }
}
