<?php
// error_reporting(E_ALL);
error_reporting(0);
ini_set('display_errors', 1);

session_start();
date_default_timezone_set('Asia/Calcutta');

$error_flag = 0;
$statusCode = 200;
$form_errors_array = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["user_mobile"])) {
        $form_errors_array['user_mobile'] = "Phone is required";
        $error_flag = 1;
    } else {
        $user_mobile = test_input($_POST["user_mobile"]);

        if (!preg_match("/^[0-9]{10}$/", $user_mobile)) {
            $form_errors_array['user_mobile'] = "Phone number must be exactly 10 digits";
            $error_flag = 1;
        }
    }

    if (empty($_POST["enquiry_email"])) {
        $form_errors_array['enquiry_email'] = "Email is required";
        $error_flag = 1;
    } else {
        $enquiry_email = strtolower( test_input($_POST["enquiry_email"]) );
        // check if e-mail address is well-formed
        if (!filter_var($enquiry_email, FILTER_VALIDATE_EMAIL)) {
          $form_errors_array['enquiry_email'] = "Invalid email format"; 
          $error_flag = 1;
        }
    }

    if (empty($_POST["mobile"])) {
        $form_errors_array['mobile'] = "Mobile number is required";
        $error_flag = 1;
    }else {
        $mobile = test_input($_POST["mobile"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]+$/",$mobile)) {
          $form_errors_array['mobile'] = "Only Numbers allowed"; 
          $error_flag = 1;
        }else if(strlen($_POST["mobile"])!=10) {
            $form_errors_array['mobile'] = "<span>Mobile should be 10 digits.</span>";
            $error_flag = 1;
        }
    }

    if ($error_flag == 0) {

        $postFields = "entry.1501287950=" .$symptoms;
        $postFields .= "entry.1833388086=" .$first_name;
        $postFields .= "entry.1521105153=" .$last_name;
        $postFields .= "entry.824970523=" .$age;
        $postFields .= "entry.1180648196=" .$phone;
        $postFields .= "entry.1162068282=" .$email;
        $postFields .= "entry.1945792923=" .$residence;
        $postFields .= "entry.366623633=" .$goals;


        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, "https://docs.google.com/forms/u/0/d/e/1FAIpQLSfg9OMkwWoV16h7GXi0jjtQHGN7tUBemdVnUBfLhg2kw9FmuA/formResponse");
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch1, CURLOPT_HEADER, 0);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        //print_r($hash);
        $result1 = curl_exec($ch1);  

        if ($mailer->sendMobileNumber($user_mobile)) {
            $response = [
                'success' => ['message' => 'success'],
                'user_mobile' => $user_mobile,
            ];
        } else {
            $response = ['error' => ['message' => 'Mail not working']];
            $statusCode = 422;
        }

    } else {
        $response = ['error' => ['error_type' => 'form', 'errors' => $form_errors_array]];
        $statusCode = 422;
    }

} else {
    $response = ['error' => ['message' => 'Invalid request']];
    $statusCode = 422;
}

header('Content-Type: application/json; charset=UTF-8');
http_response_code($statusCode);
echo json_encode($response);

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}



?>