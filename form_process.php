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

    if (!isset($_POST["symptoms"]) || count($_POST["symptoms"]) == 0) {
        $form_errors_array['symptoms'] = "Symptoms are required";
        $error_flag = 1;
    } else {
        $symptoms = array_map('test_input', $_POST["symptoms"]);
        $symptoms = implode(', ', $symptoms);
    }

    if (empty($_POST["fname"])) {
        $form_errors_array['fname'] = "First Name is required";
        $error_flag = 1;
    } else {
        $fname = test_input($_POST["fname"]);
    }

    if (empty($_POST["lname"])) {
        $form_errors_array['lname'] = "Last Name is required";
        $error_flag = 1;
    } else {
        $lname = test_input($_POST["lname"]);
    }

    if (empty($_POST["age"])) {
        $form_errors_array['age'] = "Age is required";
        $error_flag = 1;
    } else {
        $age = test_input($_POST["age"]);

        if (!preg_match("/^[0-9]/", $age)) {
            $form_errors_array['age'] = "Age must be numerical";
            $error_flag = 1;
        }
    }

    if (empty($_POST["phone"])) {
        $form_errors_array['phone'] = "Phone is required";
        $error_flag = 1;
    } else {
        $phone = test_input($_POST["phone"]);

        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $form_errors_array['phone'] = "Phone number must be exactly 10 digits";
            $error_flag = 1;
        }
    }

    if (empty($_POST["email"])) {
        $form_errors_array['email'] = "Email is required";
        $error_flag = 1;
    } else {
        $email = strtolower( test_input($_POST["email"]) );
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $form_errors_array['email'] = "Invalid email format"; 
          $error_flag = 1;
        }
    }

    if (empty($_POST["residence"])) {
        $form_errors_array['residence'] = "Residence is required";
        $error_flag = 1;
    } else {
        $residence = test_input($_POST["residence"]);
    }

    if (empty($_POST["goals"])) {
        // $form_errors_array['residence'] = "Goals is required";
        // $error_flag = 1;
    } else {
        $goals = test_input($_POST["goals"] ?? '');
    }

    // if (empty($_POST["mobile"])) {
    //     $form_errors_array['mobile'] = "Mobile number is required";
    //     $error_flag = 1;
    // }else {
    //     $mobile = test_input($_POST["mobile"]);

    //     if (!preg_match("/^[0-9]+$/",$mobile)) {
    //       $form_errors_array['mobile'] = "Only Numbers allowed"; 
    //       $error_flag = 1;
    //     }else if(strlen($_POST["mobile"])!=10) {
    //         $form_errors_array['mobile'] = "<span>Mobile should be 10 digits.</span>";
    //         $error_flag = 1;
    //     }
    // }

    if ($error_flag == 0) {

        $postFields = "&entry.1501287950=" .$symptoms;
        $postFields .= "&entry.1833388086=" .$fname;
        $postFields .= "&entry.1521105153=" .$lname;
        $postFields .= "&entry.824970523=" .$age;
        $postFields .= "&entry.1180648196=" .$phone;
        $postFields .= "&entry.1162068282=" .$email;
        $postFields .= "&entry.1945792923=" .$residence;
        $postFields .= "&entry.366623633=" .$goals;


        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, "https://docs.google.com/forms/u/0/d/e/1FAIpQLSfg9OMkwWoV16h7GXi0jjtQHGN7tUBemdVnUBfLhg2kw9FmuA/formResponse");
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch1, CURLOPT_HEADER, 0);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        //print_r($hash);
        $result1 = curl_exec($ch1);  

        $apiKey = "GvchWB2R2Nxb0Q9uo9QzLw";
        $tagId = "17254894";

        $ckFields = [
            'api_key' => $apiKey,
            'email' => $email,
            'first_name' => $fname
        ];

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, "https://api.convertkit.com/v3/tags/".$tagId."/subscribe");
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($ckFields));
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        $ckResult = curl_exec($ch2);
        curl_close($ch2);
        
        $response = [
            'success' => ['message' => 'success'],
            'user_mobile' => $phone,
        ];

        // if ($mailer->sendMobileNumber($user_mobile)) {
        //     $response = [
        //         'success' => ['message' => 'success'],
        //         'user_mobile' => $user_mobile,
        //     ];
        // } else {
        //     $response = ['error' => ['message' => 'Mail not working']];
        //     $statusCode = 422;
        // }

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