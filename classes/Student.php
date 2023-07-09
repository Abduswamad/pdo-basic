<?php
 class Student {
    public function students()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("
            SELECT 
                department_name as 'status', 
                count(*) as 'value' 
            FROM student std
            inner join department dpt
            on std.department = dpt.department_number
            GROUP by department_name
             ");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function get_all_student()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM student std
            inner join gender gnd on gnd.gender_id = std.gender");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    public function get_all_gender()
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT *  FROM gender ");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function add_student_full($student_number,$first_name,$middle_name,$last_name,$gender,$student_department, $completion_year,$image_name,$password,$email)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM student WHERE student_number=:student_number");
            $stmt->bindParam("student_number", $student_number,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            { 
                $db = null;
                return false;
            }
            else
            {
                $stmt = $db->prepare("Insert into student (student_number,first_name,middle_name,last_name,gender,department,completion_year,image,password,user_name)
                 values (:student_number,:first_name,:middle_name,:last_name,:gender,:student_department,:completion_year,:image,:hash_password,:email)");
                $stmt->bindParam("student_number", $student_number,PDO::PARAM_STR);
                $stmt->bindParam("first_name", $first_name,PDO::PARAM_STR) ;
                $stmt->bindParam("middle_name", $middle_name,PDO::PARAM_STR) ;
                $stmt->bindParam("last_name", $last_name,PDO::PARAM_STR) ;
                $stmt->bindParam("gender", $gender,PDO::PARAM_INT) ;
                $stmt->bindParam("student_department", $student_department,PDO::PARAM_INT) ;
                $stmt->bindParam("completion_year", $completion_year,PDO::PARAM_STR) ;
                $stmt->bindParam("image", $image_name,PDO::PARAM_STR) ;
                $hash_password= hash('sha256', $password); 
                $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
                $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
                $stmt->execute();
                $db = null;
                return true;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"add_student":'. $e->getMessage() .'}}';
        }

    }
    public function add_student($student_number,$first_name,$middle_name,$last_name,$gender,$student_department, $completion_year,$image_name)
    {
        try{
            
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM student WHERE student_number=:student_number");
            $stmt->bindParam("student_number", $student_number,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            { 
                $db = null;
                return false;
            }
            else
            {
                $stmt = $db->prepare("Insert into student (student_number,first_name,middle_name,last_name,gender,department,completion_year,image)
                 values (:student_number,:first_name,:middle_name,:last_name,:gender,:student_department,:completion_year,:image)");
                $stmt->bindParam("student_number", $student_number,PDO::PARAM_STR);
                $stmt->bindParam("first_name", $first_name,PDO::PARAM_STR) ;
                $stmt->bindParam("middle_name", $middle_name,PDO::PARAM_STR) ;
                $stmt->bindParam("last_name", $last_name,PDO::PARAM_STR) ;
                $stmt->bindParam("gender", $gender,PDO::PARAM_INT) ;
                $stmt->bindParam("student_department", $student_department,PDO::PARAM_INT) ;
                $stmt->bindParam("completion_year", $completion_year,PDO::PARAM_STR) ;
                $stmt->bindParam("image", $image_name,PDO::PARAM_STR) ;
                $stmt->execute();
                $db = null;
                return true;
            }
           
        }
        catch(PDOException $e) {
            echo '{"error":{"add_student":'. $e->getMessage() .'}}';
        }
    }

    public function upload_picture($image_name)
    {
        try{
            $targetDirectory = __DIR__ . "/images/students/";
            $targetFilePath = $targetDirectory . $image_name;
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES["image"]["tmp_name"];
                if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        catch(PDOException $e) {
            echo '{"error":{"upload_picture":'. $e->getMessage() .'}}';
        }
    }

    public function delete_student($id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare(" delete  from student where student_number = :student_number");
            $stmt->bindParam("student_number", $id,PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            return true;
           
        }
        catch(PDOException $e) {
            echo '{"error":{"delete_student":'. $e->getMessage() .'}}';
        }
    }

    public function get_student($id)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM student std
             inner join gender gnd on gnd.gender_id = std.gender
             WHERE student_number=:student_number");
            $stmt->bindParam("student_number", $id,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); 
            return $data;
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function edit_student($student_number,$first_name,$middle_name,$last_name,$gender)
    {
        try{
            $db = getDB();
            $stmt = $db->prepare(" update  student 
            set first_name = :first_name,
            middle_name = :middle_name,
            last_name = :last_name,
            gender = :gender
            where student_number = :student_number");
            $stmt->bindParam("first_name", $first_name,PDO::PARAM_STR);
            $stmt->bindParam("middle_name", $middle_name,PDO::PARAM_STR);
            $stmt->bindParam("last_name", $last_name,PDO::PARAM_STR);
            $stmt->bindParam("gender", $gender,PDO::PARAM_INT);
            $stmt->bindParam("student_number", $student_number,PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            return true;
        }
        catch(PDOException $e) {
            echo '{"error":{"delete_student":'. $e->getMessage() .'}}';
        }
    }
 }
?>