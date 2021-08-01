
<?php

use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;

class Utilities
{
    public static function break_class_subject($subject_ids)
    {
        if ($subject_ids) {

            // your code
            $subject_array = explode(',', $subject_ids);
            foreach ($subject_array as $subjects) {
                $class_array[] = explode('.', $subjects);
            }

            foreach ($class_array as $classes) {

                $class[] = $classes[0];
                $subject[] = $classes[1];
                $utilties = new Utilities();
                $className = $utilties->class_name($classes[0]);
                $SubjectName = $utilties->subject_name($classes[1]);

                echo ("<tr><td><input type='checkbox' name='chkbox[]'></td>"
                    . "<td><input type='hidden' name=class[] value='" . $classes[0] . "'>"
                    . "<input type ='text' disabled='disabled' value='" . $className . "'></td>"
                    . "<td><input type='hidden' name=subject[] value='" . $classes[1] . "'>"
                    . "<input type ='text' disabled='disabled' value='" . $SubjectName . "'>"
                    . "</td></tr>");
            }
        } else {
            echo "<tr><td></td> <td><b>No Class Added </b></td> <td><b> No Subject Added </b> </td></tr>";
        }
    }

    public function class_name($id)
    {
        $classes = new Classes();
        $class = $classes->where('id', $id)->get();
        return ($class[0]->comment);
    }

    public function subject_name($id)
    {
        $subjects = new Subject();
        $subject = $subjects->where('id', $id)->get();
        return ($subject[0]->subject);
    }

    public static function student_email_ver($id)
    {
        $students = new Student();
        $student = $students->where('id', $id)->get();
        return ($student[0]->email_verify);
        // if ($student[0]->email_verify == "1") {
        //     return ('<button type="button" class="btn btn-primary"
        //     data-toggle="modal" data-target="#requestModal">
        //     Send Hire request &nbsp;<span
        //         class="fa fa-paper-plane"></span> </button>');
        // }
        // return ('<a href="#"> Please verify your mail to Send Request to
        //     this tutor </a>');
    }
}
