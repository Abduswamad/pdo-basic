<?php
 class Form {
    public function form_statuses()
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
    public function form_comment($form_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT 
                   frm_cmt.comment 
                   ,frm_cmt.comment_date 
                   ,stf_role.role_name
                   ,stf.first_name
                   ,stf.middle_name
                   ,stf.last_name
                FROM form_comment frm_cmt 
                inner join staff  stf
                on frm_cmt.staff = stf.staff_number
                inner join staff_role stf_role
                on stf_role.role_id = stf.staff_role
                WHERE form=:form 
                order by frm_cmt.comment_date desc
             ");
            $stmt->bindParam("form", $form_id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function form_detail($id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT 
                frm.form_id,
                frm.student,
                frm.form_step,
                std.first_name,
                std.middle_name,
                std.last_name,
                std.completion_year,
                gnd.gender_name,
                dpt.department_name,
                fstp.step_name,
                std.image
            FROM form frm
            inner join student std
            on std.student_number = frm.student
            inner join  gender gnd
            on gnd.gender_id = std.gender
            inner join  department dpt
            on dpt.department_number = std.department
            inner join form_step fstp
            on fstp.step_id = frm.form_step
            WHERE frm.form_id = :form_id ");
            $stmt->bindParam("form_id", $id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); 
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"get_staff":'. $e->getMessage() .'}}';
        }
    }
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
                $staff_role= 8;
                $stmt = $db->prepare("SELECT * FROM form frm 
                    inner join form_step fst on frm.form_step = fst.step_id
                    inner  join student std on std.student_number = frm.student
                    inner join department dpt  on dpt.department_number = std.department
                    where frm.form_step = :staff_role
                ");
                 $stmt->bindParam("staff_role", $staff_role,PDO::PARAM_INT);
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
            $form_step =8;
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

    public function add_comment_staff($form,$decission,$comment,$staff_id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM form WHERE form_id=:form_id ");
            $stmt->bindParam("form_id", $form,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); 
            $form_step =  $data->form_step;
            if($decission == "Accept")
            {
                $form_step = $form_step+1;
                $stmt = $db->prepare("update form  set  form_step = :form_step
                where  form_id = :form_id");
                $stmt->bindParam("form_id", $form,PDO::PARAM_INT);
                $stmt->bindParam("form_step", $form_step,PDO::PARAM_INT);
                $stmt->execute();
                $form_step = $form_step-1;
                
            }
            $stmt = $db->prepare("Insert into form_comment (form,staff,comment,comment_date,step)
            values (:form,:staff,:comment,CURRENT_TIMESTAMP(),:step)");
            $stmt->bindParam("form", $form,PDO::PARAM_INT);
            $stmt->bindParam("staff", $staff_id,PDO::PARAM_STR);
            $stmt->bindParam("comment", $comment,PDO::PARAM_STR);
            $stmt->bindParam("step", $form_step,PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            return true;
           
        }
        catch(PDOException $e) {
            echo '{"error":{"add_staff":'. $e->getMessage() .'}}';
        }
    }
     
 }
?>