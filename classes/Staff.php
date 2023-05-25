<?php
 class Staff {
    public function staffs()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("
            SELECT 
                step_name as 'status', 
                count(*) as 'value' 
            FROM form frm
            inner join form_step fst
            on frm.form_step = fst.step_id
            GROUP by step_name
             ");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function get_all_staff($sessin_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM staff stf
             inner join staff_role stp on stp.role_id = stf.staff_role
             WHERE staff_number != :staff_number ");
            $stmt->bindParam("staff_number", $sessin_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function get_all_staff_department()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM department ");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function get_all_staff_role()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM staff_role ");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function add_staff($staff_number,$first_name,$middle_name,$last_name,$staff_role,$staff_department)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM staff WHERE staff_number=:staff_number");
            $stmt->bindParam("staff_number", $staff_number,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            { 
                
                $db = null;
                return false;
            }
            else
            {
                $stmt = $db->prepare("Insert into staff (staff_number,first_name,middle_name,last_name,staff_role,department)
                 values (:staff_number,:first_name,:middle_name,:last_name,:staff_role,:staff_department)");
                $stmt->bindParam("staff_number", $staff_number,PDO::PARAM_STR);
                $stmt->bindParam("first_name", $first_name,PDO::PARAM_STR) ;
                $stmt->bindParam("middle_name", $middle_name,PDO::PARAM_STR) ;
                $stmt->bindParam("last_name", $last_name,PDO::PARAM_STR) ;
                $stmt->bindParam("staff_role", $staff_role,PDO::PARAM_INT) ;
                $stmt->bindParam("staff_department", $staff_department,PDO::PARAM_INT) ;
                $stmt->execute();
                $db = null;
                return true;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"add_staff":'. $e->getMessage() .'}}';
        }
    }
    public function dalete_staff($id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare(" delete  from staff where staff_number = :staff_number");
            $stmt->bindParam("staff_number", $id,PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            return true;
           
        }
        catch(PDOException $e) {
            echo '{"error":{"dalete_staff":'. $e->getMessage() .'}}';
        }
    }

    public function get_staff($id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM staff stf
            inner join staff_role stp on stp.role_id = stf.staff_role
            WHERE staff_number = :staff_number ");
            $stmt->bindParam("staff_number", $id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); 
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"get_staff":'. $e->getMessage() .'}}';
        }
    }
    public function edit_staff($staff_number,$first_name,$middle_name,$last_name,$staff_role)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare(" update  staff set first_name = :first_name,
            middle_name = :middle_name, last_name = :last_name , staff_role = :staff_role where staff_number = :staff_number");
            $stmt->bindParam("first_name", $first_name,PDO::PARAM_STR);
            $stmt->bindParam("middle_name", $middle_name,PDO::PARAM_STR);
            $stmt->bindParam("last_name", $last_name,PDO::PARAM_STR);
            $stmt->bindParam("staff_role", $staff_role,PDO::PARAM_INT);
            $stmt->bindParam("staff_number", $staff_number,PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            return true;
           
        }
        catch(PDOException $e) {
            echo '{"error":{"dalete_staff":'. $e->getMessage() .'}}';
        }
    }
 }
?>