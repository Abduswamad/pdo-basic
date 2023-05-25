<?php
 class Account {
    public function staff_profile($sessin_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("
            SELECT 
                stf.staff_number
                ,stf.first_name
                ,stf.middle_name
                ,stf.last_name
                ,stf.email
                ,stf.title
                ,dpt.department_name
                ,str.role_name
            FROM staff stf 
            inner join department dpt
            on  dpt.department_number  = stf.department 
            inner join staff_role str
            on str.role_id = stf.staff_role
            WHERE staff_number=:staff_number");
            $stmt->bindParam("staff_number", $sessin_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function staff_sign_up($reg_number,$email,$password)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM staff WHERE staff_number=:staff_number");
            $stmt->bindParam("staff_number", $reg_number,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                $stmt = $db->prepare("Update staff set email = :email
                , password = :hash_password where staff_number = :staff_number");
                $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
                $hash_password= hash('sha256', $password); 
                $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
                $stmt->bindParam("staff_number", $reg_number,PDO::PARAM_STR) ;
                $stmt->execute();
                $db = null;
                return true;
            }
            else
            {
                $db = null;
                return false;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"student_sign_up":'. $e->getMessage() .'}}';
        }
    }
    public function student_sign_up($reg_number,$email,$password)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM student WHERE student_number=:student_number");
            $stmt->bindParam("student_number", $reg_number,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                $stmt = $db->prepare("Update student set user_name = :email
                , password = :hash_password where student_number = :student_number");
                $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
                $hash_password= hash('sha256', $password); 
                $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
                $stmt->bindParam("student_number", $reg_number,PDO::PARAM_STR) ;
                $stmt->execute();
                $db = null;
                return true;
            }
            else
            {
                $db = null;
                return false;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"student_sign_up":'. $e->getMessage() .'}}';
        }
    }

    public function staff_sign_in($email,$password)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM staff WHERE email=:email and password=:hash_password");
            $hash_password= hash('sha256', $password);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                $data=$stmt->fetch(PDO::FETCH_OBJ);
                $_SESSION['login_session_id']=$data->staff_number;
                $db = null;
                return true;
            }
            else
            {
                $db = null;
                return false;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"student_sign_up":'. $e->getMessage() .'}}';
        }
    }

    public function student_sign_in($email,$password)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM student WHERE user_name=:email and password=:hash_password");
            $hash_password= hash('sha256', $password);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                $data=$stmt->fetch(PDO::FETCH_OBJ);
                $_SESSION['login_session_id']=$data->student_number;
                $db = null;
                return true;
            }
            else
            {
                $db = null;
                return false;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"student_sign_up":'. $e->getMessage() .'}}';
        }
    }
    public function student_session_detail($sessin_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT first_name,middle_name,last_name FROM student WHERE student_number=:student_number");
            $stmt->bindParam("student_number", $sessin_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function staff_session_detail($sessin_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT staff_role,first_name,middle_name,last_name FROM staff WHERE staff_number=:staff_number");
            $stmt->bindParam("staff_number", $sessin_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
     
 }
?>