<!DOCTYPE html>
<html>
<body>
<?php 
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

$exp=explode('*',$text);
$store = array(); 

if($text == ""){
    $response = "CON Please select your Insurance type \n";
    $response .= "1. Health \n";
    $response .= "2. Motor \n";
    $response .= "3. Life";
}

else if($text == "3"){
    $response = "CON Please enter your Name \n";
    $store["Insurance"] = "Life" ;

}

else if($exp[0]=="3" && $exp[1] && !$exp[2]){
    $store["Name"] = $exp[1];
    $response = "CON Please Enter your Date of Birth (ex:12-09-2001) \n";
}
else if($exp[0] == "3" &&($exp[2]) && (!$exp[3])){
    $response = "CON Enter your Phone Number\n" ;
    $store["DOB"] = $exp[2] ;
}
else if ($exp[0] == "3" &&($exp[3]) && (!$exp[4])){
	$store["Phone Number"] = $exp[3];
    $response = "CON Do you Smoke? \n " ;
    $response .= "1.Yes \n";
    $response .= "2.No \n";
}
else if($exp[0] == "3" &&($exp[4] == "1") && (!$exp[5])){
    $response = "CON Do you have any Disease? \n";
    $response .= "1.Yes \n";
    $response .= "2.No \n";
    $store["isSmoker"] = "Yes" ;
}
else if($exp[0] == "3" &&($exp[4] == "2") && (!$exp[5])){
    $response = "CON Do you have any Disease? \n";
    $response .= "1.Yes \n";
    $response .= "2.No \n";
    $store["isSmoker"] = "No" ;
}
 else if ($exp[0] == "3" && ($exp[5] == "1") && (!$exp[6])){
    $response = "CON Please enter your Occupation \n";
    $store["PED"] = "Yes" ;
} 
 else if ($exp[0] == "3" && ($exp[5] == "2") && (!$exp[6])){
    $response = "CON Please enter your Occupation \n";
    $store["PED"] = "No" ;
}
else if ($exp[0] == "3" && ($exp[6]) && (!$exp[7])){
    $response = "CON Please enter your Salary(eg. 1000000) \n";
    $store["Ocuupation"] = $exp[6];
}
else if ($exp[0] == "3" && (($exp[7])) && (!$exp[8])){
	$store["Salary"] = $exp[7];
    if ((int)$exp[7] > 0) {
        $response = "CON Please enter your Education \n";
    } else {
        $response = "END Sorry you entered Invalid Salary \n";
    } 
}
else if ($exp[0] == "3" && (($exp[8])) && (!$exp[9])){
	$store["Education"] = $exp[8];
    $response = "CON Please Enter Your Age  \n";
}
else if ($exp[0] == "3" && ($exp[9]) && (!$exp[10])){
	$num = (int)$exp[9];
    $store["Age"] = $exp[9];
    if($num <= 18 || $num >= 80){ //adult so >18
        $response = "END Sorry you are not eligible for insurance";
    }
    else {
    	$response = "CON Please Select the Sum Insured \n";
    	$response .= "1.25,00,000 \n";
    	$response .= "2.50,00,000 \n";
    	$response .= "3.1,00,00,000 \n";
    	$response .= "3.2,00,00,000 \n";
    }
}
else if ($exp[0] == "3" && $exp[10] == "1" && (!$exp[11])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "2500000" ;
}
else if ($exp[0] == "3" && $exp[10] == "2" && (!$exp[11])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "5000000" ;
}
else if ($exp[0] == "3" && $exp[10] == "3" && (!$exp[11])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "10000000" ;
}
else if ($exp[0] == "3" && $exp[10] == "4" && (!$exp[11])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "20000000" ;
}
else if ($exp[0]=="3" && ($exp[11])&& (!$exp[12])){
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

</body>
</html>
