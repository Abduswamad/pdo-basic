<?php
 class Form {
    public function staff_forms($staff_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM staff WHERE staff_number=:staff_id");
            $stmt->bindParam("staff_id", $staff_id,PDO::PARAM_STR);
            $stmt->execute();
            $staff = $stmt->fetch(PDO::FETCH_OBJ); 
            $staff_role= $staff->staff_role;
            $department= $staff->department;
            if($staff_role == 100 ){
                $stmt = $db->prepare("SELECT * FROM form frm 
                    inner join form_step fst on frm.form_step = fst.step_id
                    inner  join student std on std.student_number = frm.student
                    inner join department dpt  on dpt.department_number = std.department
                ");
                $stmt->execute();
                $data = $stmt->fetchAll();
            }else if($staff_role == 7 ){
                $stmt = $db->prepare("SELECT * FROM form frm 
                    inner join form_step fst on frm.form_step = fst.step_id
                    inner  join student std on std.student_number = frm.student
                    inner join department dpt  on dpt.department_number = std.department
                    where frm.form_step = :staff_role and dpt.department_number = :department
                ");
                $stmt->bindParam("staff_role", $staff_role,PDO::PARAM_INT);
                $stmt->bindParam("department", $department,PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll();
            }else{
                $stmt = $db->prepare("SELECT * FROM form frm 
                    inner join form_step fst on frm.form_step = fst.step_id
                    inner  join student std on std.student_number = frm.student
                    inner join department dpt  on dpt.department_number = std.department
                    where frm.form_step = :staff_role
                ");
                $stmt->bindParam("staff_role", $staff_role,PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll();
            };
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"staff_forms":'. $e->getMessage() .'}}';
        }
    }
    public function student_form($student_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM form frm 
                inner join form_step fst on frm.form_step = fst.step_id
                inner  join student std on std.student_number = frm.student
                inner join department dpt  on dpt.department_number = std.department
                WHERE student=:student_id 
             ");
            $stmt->bindParam("student_id", $student_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function create_form($student_id)
    {
        try{
            $db = getDB();
            $form_step =7;
            $stmt = $db->prepare("SELECT * FROM form WHERE student=:student_id and form_step != :form_step");
            $stmt->bindParam("student_id", $student_id,PDO::PARAM_STR);
            $stmt->bindParam("form_step", $form_step,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            { 
                $db = null;
                return false;
            }
            else
            {
                $form_step =1;
                $stmt = $db->prepare("Insert into form (student,form_step)
                 values (:student,:form_step)");
                $stmt->bindParam("student", $student_id,PDO::PARAM_STR);
                $stmt->bindParam("form_step", $form_step,PDO::PARAM_INT);
                $stmt->execute();
                $db = null;
                return true;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"add_staff":'. $e->getMessage() .'}}';
        }
    }
     
 }
?>