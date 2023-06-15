<?php 
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

$exp=explode('*',$text);

if($text == ""){
    $response = "CON Please select your Insurance type \n";
    $response .= "1. Health \n";
    $response .= "2. Motor \n";
    $response .= "3. Life";
}

else if($text == "3"){
    $response = "CON Please enter your Age \n";

}

else if($exp[0]=="3" && $exp[1] && !$exp[2]){
    $num = (int)$exp[1];
    if($num <= 5 || $num >= 80){
        $response = "END Sorry you are not eligible for insurance";
    }
    else {
        $response = "CON Are you a Smoker? \n";
        $response .= "1.Yes \n";
        $response .= "2.No ";
    }
}

else if($exp[0] == "3" &&($exp[2] == "1" || $exp[2] == "2") && (!$exp[3])){
    $response = "CON Do you have any Disease? \n";
    $response .= "1.Yes \n";
    $response .= "2.No \n";
   
}
 else if ($exp[0] == "3" && ($exp[3] == "1"|| $exp[3] == "2") && (!$exp[4])){
    $response = "CON Please enter your Occupation \n";
} 
else if ($exp[0] == "3" && ($exp[4]) && (!$exp[5])){
    $response = "CON Please enter your Salary(eg. 1000000) \n";
}
else if ($exp[0] == "3" && (($exp[5])) && (!$exp[6])){
    if ((int)$exp[5] > 0) {
        $response = "CON Please enter your Education \n";
    } else {
        $response = "END Sorry you entered Invalid Salary \n";
    } 
}
else if($exp[0] == "3" && ($exp[6]) && (!$exp[7])){
    $response = "CON Top 5 Quotes \n";
    $response .= "1.ICICI - 1500/- \n";
    $response .= "2.HDFC -  2000/- \n";
    $response .= "3.Digit - 1670/- \n";
    $response .= "4.Max -  1450/- \n";
    $response .= "5.Chola - 1388/- \n" ;
}
else if ($exp[0]=="3" && ($exp[7])&& (!$exp[8])){
    $response = "CON Confirmation for policy booking \n" ;
    $response .= "1.Yes \n" ;
    $response .= "2.No \n";
   
} else if($exp)
{
    $response = "END Thank you for your response";
}
header('Content-type:text/plain');
echo  $response;

?>