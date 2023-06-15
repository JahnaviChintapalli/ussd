<!DOCTYPE html>
<html>
<body>

<?php
$serviceId = $_POST["serviceId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

$exp = explode("*",$text);
$store = array();

if($text == ""){
    $response = "CON Please select your Insurance type \n";
    $response .= "1. Health \n";
    $response .= "2. Motor \n";
    $response .= "3. Life";
}

else if($text == "1"){
    $response = "CON Please enter your Gender \n";
    $response .="1.Male \n";
    $response .="2.Female \n" ;  
    $store["Insurance"] = "Health" ;

}

else if ($exp[0] == "1" && $exp[1] == "1" ){
    $response = "CON Please enter your Age \n";
	$store["Gender"] = "Male";
}
else if ($exp[0]== "1" && $exp[1] == "2") {
	$response = "CON Please enter your Age \n";
	$store["Gender"] = "Female"; 
}


else if($exp[0]=="1" && $exp[1] && $exp[2] && (!$exp[3]) ){
    $num = (int)$exp[2];
    $store["Age"] = $exp[2];
    if($num <= 18 || $num >= 80){ //adult so >18
        $response = "END Sorry you are not eligible for insurance";
    }
    else {
    	$response = "CON Do you have any Disease? \n";
    	$response .= "1.Yes \n";
    	$response .= "2.No \n";
    }
}
else if ($exp[0] == "1" && $exp[3] == "1" && (!$exp[4]) ){
	$response = "CON Please Enter your Pincode \n";
	$store["PED"] = "Yes";
}
else if ($exp[0] == "1" && $exp[3] == "2" && (!$exp[4]) ){
	$response = "CON Please Enter your Pincode \n";
	$store["PED"] = "No";
}
else if ($exp[0] == "1" && $exp[4] && (!$exp[5])){
    $response = "CON Please Select the Sum Insured \n";
    $response .= "1.5,00,000 \n";
    $response .= "2.10,00,000 \n";
    $response .= "3.15,00,000 \n";
    $store["Pincode"] = $exp[4] ;
}
else if ($exp[0] == "1" && $exp[5] == "1" && (!$exp[6])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "500000" ;
}
else if ($exp[0] == "1" && $exp[5] == "2" && (!$exp[6])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "1000000" ;
}
else if ($exp[0] == "1" && $exp[5] == "3" && (!$exp[6])) {
	$response = "CON Top 5 quotes for You \n";
    $store["SumInsured"] = "1500000" ;
}
else if ($exp[0]=="3" && ($exp[7])&& (!$exp[8])){
    $response = "CON Confirmation for policy booking \n" ;
    $response .= "1.Yes \n" ;
    $response .= "2.No \n";
}
else if($exp)
{
    $response = "END Thank you for your response";
}
header('Content-type:text/plain');
echo  $response;
?>

</body>
</html>
