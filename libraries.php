<?php

function greetings() {
    echo "Hello World!";
};



// $interval = 5; // Interval in seconds

// while (true) {
//     doAction();
//     sleep($interval);
// }
function repeat($store, $phoneNumber, $leadId) {
    $count = 5;
    $interval = 5;
    $quotes = array();
    while($count){
        $quotes = lifeQuotes($store, $phoneNumber, $leadId);
        $count = $count-1;
        if(count($quotes) >= 5) {
            return $quotes;
        }
        if($count)sleep($interval);
        if(!$count){
            return $quotes;
        }
    }
};

function lifeQuotes($store, $phoneNumber, $leadId) {
    echo 'in life quotes';
    // if(!$leadId)$leadId = leadLife($store, $phoneNumber);
    $apiUrl = 'https://leadmiddlewarestaging.insurancedekho.com/api/life/v1/quotes?'; 

    $jsonData = [
        "leadId"=> $leadId,
        "planType"=> "term",
        "payType"=> "regular_pay",
        "returnType"=> "lump_sum",
        "paymentMode"=> "monthly",
        "source"=> "B2C",
        "subSource"=> "INSURANCE-DEKHO",
        "medium"=> "INSURANCE-DEKHO",
        "dob"=> $store["date_of_birth"],
        "gender"=> "M",
        "isTobacco"=> $store["is_smoke_tobacco"],
        "annualIncome"=> $store["annual_income"],
        "annualIncomeDisplayName"=> $store["annual_income_display_name"],
        "occupation"=> $store["occupation"],
        "educationQualification"=> $store["education_qualification"],
        "sumAssured"=> 20000000,
        "coverUpto"=> 50,
        "customerName"=> $store["name"],
        "occupationDisplayName"=> $store["occupation_display_name"],
        "educationQualificationDisplayname"=> $store["education_qualification_display_name"],
        "subPlanType"=> "base",
        "isdetailsUpdated"=> 0,
        "pincode"=> "122010",
        "currentStep"=> "quote",
        "isNri"=> 0,
    ];
    $reqData = json_encode($jsonData);
    $headers = [
        'header'  => "Content-type: application/json",
    ];

    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $reqData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo $response;
        $quoteData = json_decode($response);
        $quotes = $quoteData['data']['quotes'];
        return $quotes;
    }

    curl_close($curl);
};

function leadLife($store, $phoneNumber){
    echo 'in lead life';

    $apiUrl = "https://leadmiddlewarestaging.insurancedekho.com/api/life/v1/lead";

    $jsonData = [
        "customer_name"=> $store["name"],
        "source"=> "B2C",
        "sub_source"=> "INSURANCE-DEKHO",
        "medium"=> "INSURANCE-DEKHO",
        "utm_source"=> "Direct",
        "utm_campaign"=> "",
        "utm_medium"=> "",
        "browseeid"=> "https://browsee.io/app/session/185c32c5878c",
        "is_otp"=> false,
        "is_verified"=> false,
        "verified_source"=> "",
        "connectoid"=> "996f41e3-c1b1-8d62-2062-abab361eb1f5",
        "utm_device"=> "",
        "utm_term"=> "",
        "product_type"=> "term",
        "meeting_source"=> "",
        "meeting_medium"=> "",
        "meeting_campaign"=> "",
        "page_template_name"=> "TermLandingPage",
        "current_step"=> "lead_form",
        "referrer"=> "",
        "mobile_number"=> $phoneNumber,
        "country_code"=> "+91",
        "country_name"=> "INDIA",
        "customer_gender"=> "M",
        "whatsAppOptIn"=> true,
        "date_of_birth"=> $store["date_of_birth"],
        "education_qualification"=> $store["education_qualification"],
        "education_qualification_display_name"=> $store["education_qualification_display_name"],
        "annual_income"=> $store["annual_income"],
        "annual_income_display_name"=> $store["annual_income_display_name"],
        "occupation"=> $store["occupation"],
        "occupation_display_name"=> $store["occupation_display_name"],
        "is_smoke_tobacco"=> $store["is_smoke_tobacco"],
    ];
    $reqData = json_encode($jsonData);
    $headers = [
        'header'  => "Content-type: application/json",
    ];
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $reqData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
    } else {
        // Process the response as needed
        echo $response;
        $leadData = json_decode($response);
        $leadId = $leadData['data']['lead_id'];
        $quotes = repeat($store, $phoneNumber, $leadId);
        return $quotes;
        // return $leadId;
        // print_r(json_decode($response));
    }

    curl_close($curl);
};


function healthQuotes() {
    echo 'in health quotes';
    $apiUrl = "https://healthquotestage.girnarinsurance.com/health/quotes/get-quotes";

    $jsonData = [
        "visit_id"=> "64903d72adc22612bd274f49",
        "updated"=> false,
        "group_id"=> 1,
        "plan_type"=> "base",
        "nstp_plans"=> "true",
        "portable_plans"=> false,
        "groupBy"=> "insurers",
        "prefer_plan_type"=> "base",
        "source"=> "AGENCY",
        "sub_source"=> "POS",
        "medium"=> "POS",
    ];
    $reqData = json_encode($jsonData);

    $headers = [
        'header'  => "Content-type: application/json",
    ];
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $reqData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
    } else {
        // Process the response as needed
        echo $response;
        // print_r(json_decode($response));
    }

    curl_close($curl);

};


?>
