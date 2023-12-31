<!DOCTYPE html>
<html>

<body>
    <?php
    ini_set( 'error_reporting', E_ALL );
    ini_set( 'display_errors', true );
    require "libraries.php";
    $sessionId = $_POST["sessionId"];
    $serviceCode = $_POST["serviceCode"];
    $phoneNumber = $_POST["phoneNumber"];
    $text = $_POST["text"];

    $exp = explode('*', $text);
    $store = array();
    $quoteData = array();

    if ($text == "") {
        $response = "CON Please select your Insurance type \n";
        $response .= "1. Health \n";
        $response .= "2. Life";
    } else if ($text == "2") {
        $response = "CON Please enter your Name \n";
        $store["insurance"] = "Life";

    } else if ($exp[0] == "2" && $exp[1] && !$exp[2]) {
        $store["name"] = $exp[1];
        $response = "CON Please Enter your Date of Birth (YYYY-MM-DD) \n";
    } else if ($exp[0] == "2" && ($exp[2]) && (!$exp[3])) {
        $response = "CON Enter your Phone Number\n";
        $store["date_of_birth"] = $exp[2];
    } else if ($exp[0] == "2" && ($exp[3]) && (!$exp[4])) {
        $store["phone_number"] = $exp[3];
        $response = "CON Do you Smoke? \n ";
        $response .= "1.Yes \n";
        $response .= "2.No \n";
    } else if ($exp[0] == "2" && ($exp[4] == "1") && (!$exp[5])) {
        $response = "CON Do you have any Disease? \n";
        $response .= "1.Yes \n";
        $response .= "2.No \n";
        $store["is_smoke_tobacco"] = 1;
    } else if ($exp[0] == "2" && ($exp[4] == "2") && (!$exp[5])) {
        $response = "CON Do you have any Disease? \n";
        $response .= "1.Yes \n";
        $response .= "2.No \n";
        $store["is_smoke_tobacco"] = 0;
    } else if ($exp[0] == "2" && ($exp[5] == "1") && (!$exp[6])) {
        $response = "CON Please select your Occupation \n";
        $response .= "1.Salaried \n";
        $response .= "2.Self Employed \n";
        $store["ped"] = "Yes";
    } else if ($exp[0] == "2" && ($exp[5] == "2") && (!$exp[6])) {
        $response = "CON Please select your Occupation \n";
        $response .= "1.Salaried \n";
        $response .= "2.Self Employed \n";
        $store["ped"] = "No";
    } else if ($exp[0] == "2" && ($exp[6] === "1") && (!$exp[7])) {
        $response = "CON Please select your Annual Income  \n";
        $response .= "1.Less than 2 Lac \n";
        $response .= "2.2 Lac to 4.9 Lac \n";
        $response .= "3.5 Lac to 6.9 Lac \n";
        $response .= "4.7 Lac to 9.9 Lac \n";
        $response .= "5.10 Lac to 14.9 Lac \n";
        $store["occupation"] = "salaried";
        $store["occupation_display_name"] = "Salaried";
    } else if ($exp[0] == "2" && ($exp[6] === "2") && (!$exp[7])) {
        $response = "CON Please select your Annual Income  \n";
        $response .= "1.Less than 2 Lac \n";
        $response .= "2.2 Lac to 4.9 Lac \n";
        $response .= "3.5 Lac to 6.9 Lac \n";
        $response .= "4.7 Lac to 9.9 Lac \n";
        $response .= "5.10 Lac to 14.9 Lac \n";
        $store["occupation"] = "self-employed";
        $store["occupation_display_name"] = "Self Employed";
    } else if ($exp[0] == "2" && (($exp[7]) === "1") && (!$exp[8])) {
        $store["annual_income"] = 199999;
        $store["annual_income_display_name"] = "Less than 2 Lac";
        $response = "CON Please enter your Education \n";
        $response .= "1. College Graduate & above \n";
        $response .= "2. 12th Pass \n";
        $response .= "3. 10th Pass & below \n";
    } else if ($exp[0] == "2" && (($exp[7]) === "2") && (!$exp[8])) {
        $store["annual_income"] = 499999;
        $store["annual_income_display_name"] = "2 Lac to 4.9 Lac";
        $response = "CON Please enter your Education \n";
        $response .= "1. College Graduate & above \n";
        $response .= "2. 12th Pass \n";
        $response .= "3. 10th Pass & below \n";
    } else if ($exp[0] == "2" && (($exp[7]) === "3") && (!$exp[8])) {
        $store["annual_income"] = 699999;
        $store["annual_income_display_name"] = "5 Lac to 6.9 Lac";
        $response = "CON Please enter your Education \n";
        $response .= "1. College Graduate & above \n";
        $response .= "2. 12th Pass \n";
        $response .= "3. 10th Pass & below \n";
    } else if ($exp[0] == "2" && (($exp[7]) === "4") && (!$exp[8])) {
        $store["annual_income"] = 999999;
        $store["annual_income_display_name"] = "7 Lac to 9.9 Lac";
        $response = "CON Please enter your Education \n";
        $response .= "1. College Graduate & above \n";
        $response .= "2. 12th Pass \n";
        $response .= "3. 10th Pass & below \n";
    } else if ($exp[0] == "2" && (($exp[7]) === "5") && (!$exp[8])) {
        $store["annual_income"] = 1499999;
        $store["annual_income_display_name"] = "10 Lac to 14.9 Lac";
        $response = "CON Please enter your Education \n";
        $response .= "1. College Graduate & above \n";
        $response .= "2. 12th Pass \n";
        $response .= "3. 10th Pass & below \n";
    } else if ($exp[0] == "2" && (($exp[8]) === "1") && (!$exp[9])) {
        $store["education_qualification"] = "G";
        $store["education_qualification_display_name"] = "College Graduate & above";
        $quoteData = leadLife($store, $phoneNumber);
        $quotes = $quoteData['quotes'];
        $response = "CON Top 5 Quotes for You";
        for($i = 0; $i < count($quotes); $i++){
            $response .= $i . '.' . $quotes[$i]["subPlanName"];
        };
    } else if ($exp[0] == "2" && (($exp[8]) === "2") && (!$exp[9])) {
        $store["education_qualification"] = "HSC";
        $store["education_qualification_display_name"] = "12th Pass";
        $quoteData = leadLife($store, $phoneNumber);
        $quotes = $quoteData['quotes'];
        $response = "CON Top 5 Quotes for You";
        for($i = 0; $i < count($quotes); $i++){
            $response .= $i . '.' . $quotes[$i]["subPlanName"];
        };
    } else if ($exp[0] == "2" && (($exp[8]) === "3") && (!$exp[9])) {
        $store["education_qualification"] = "PM";
        $store["education_qualification_display_name"] = "10th Pass & below";
        $quoteData = leadLife($store, $phoneNumber);
        $quotes = $quoteData['quotes'];
        $response = "CON Top 5 Quotes for You";
        for($i = 0; $i < count($quotes); $i++){
            $response .= $i . '.' . $quotes[$i]["subPlanName"];
        };
    } else if ($exp[0] == "2" && ($exp[9]) && (!$exp[10])) {
        $num = (int)$exp[9];
        $quotes = $quoteData['quotes'];
        $store["quote_id"] = $quotes[$num-1]["planId"];
        $store["lead_id"] = $quoteData['leadId']; 
        $response = "CON Confirmation for policy booking \n";
        $response .= "1.Yes \n";
        $response .= "2.No \n";

    } else if ($text == "1") {
        $response = "CON Please enter your Gender \n";
        $response .= "1.Male \n";
        $response .= "2.Female \n";
        $store["insurance"] = "Health";

    } else if ($exp[0] == "1" && $exp[1] == "1" && (!$exp[2])) {
        $response = "CON Please enter your Age \n";
        $store["gender"] = "M";
    } else if ($exp[0] == "1" && $exp[1] == "2" && (!$exp[2])) {
        $response = "CON Please enter your Age \n";
        $store["gender"] = "F";
    } else if ($exp[0] == "1" && $exp[1] && $exp[2] && (!$exp[3])) {
        $num = (int) $exp[2];
        $store["age"] = $num;
        if ($num <= 18 || $num >= 80) { //adult so >18
            $response = "END Sorry you are not eligible for insurance";
        } else {
            $response = "CON Do you have any Disease? \n";
            $response .= "1.Yes \n";
            $response .= "2.No \n";
        }
    } else if ($exp[0] == "1" && $exp[3] == "1" && (!$exp[4])) {
        $response = "CON Please Enter your Pincode \n";
        $store["ped"] = "Yes";
    } else if ($exp[0] == "1" && $exp[3] == "2" && (!$exp[4])) {
        $response = "CON Please Enter your Pincode \n";
        $store["ped"] = "No";
    } else if ($exp[0] == "1" && $exp[4] && (!$exp[5])) {
        $response = "CON Please Select the Sum Insured \n";
        $response .= "1.5,00,000 \n";
        $response .= "2.10,00,000 \n";
        $response .= "3.15,00,000 \n";
        $store["pincode"] = $exp[4];
    } else if ($exp[0] == "1" && $exp[5] == "1" && (!$exp[6])) {
        $response = "CON Top 5 quotes for You \n";
        $response .= "1.ICICI - 1500/- \n";
        $response .= "2.HDFC -  2000/- \n";
        $response .= "3.Digit - 1670/- \n";
        $response .= "4.Max -  1450/- \n";
        $response .= "5.Chola - 1388/- \n" ;
        $store["SumInsured"] = "500000";
    } else if ($exp[0] == "1" && $exp[5] == "2" && (!$exp[6])) {
        $response = "CON Top 5 quotes for You \n";
        $response .= "1.ICICI - 1500/- \n";
        $response .= "2.HDFC -  2000/- \n";
        $response .= "3.Digit - 1670/- \n";
        $response .= "4.Max -  1450/- \n";
        $response .= "5.Chola - 1388/- \n" ;
        $store["SumInsured"] = "1000000";
    } else if ($exp[0] == "1" && $exp[5] == "3" && (!$exp[6])) {
        $response = "CON Top 5 quotes for You \n";
        $response .= "1.ICICI - 1500/- \n";
        $response .= "2.HDFC -  2000/- \n";
        $response .= "3.Digit - 1670/- \n";
        $response .= "4.Max -  1450/- \n";
        $response .= "5.Chola - 1388/- \n" ;
        $store["SumInsured"] = "1500000";
    } else if ($exp[0] == "1" && ($exp[6]) && (!$exp[7])) {
        $store["quotes"] = $exp[6];
        $response = "CON Confirmation for policy booking \n";
        $response .= "1.Yes \n";
        $response .= "2.No \n";
    } else if ($exp) {
        if($exp[0] == '1' && $exp[7]){
            if($exp[7] == "1")$store["confirm"] = 1;
            else $store["confirm"] = 0;
        }
        $response = "END Thank you for your response";
    }
    header('Content-type:text/plain');
    echo $response;

    ?>

</body>

</html>
