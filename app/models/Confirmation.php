<?php

class Confirmation extends Dbh
{
    public function deleteCartItems($cartId)
    {
        $sql = "DELETE FROM cart_items WHERE cart_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$cartId])) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
}
