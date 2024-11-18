<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header( 'HTTP/1.0 200 OK' );
    flush();
    function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }
    
        $signature = md5( $tempParamString );
        return ( $pfData['signature'] === $signature );
    } 


    $data = file_get_contents('php://input');
    $pfData = $_POST;
    file_put_contents('webhook1_data.log', $data . PHP_EOL, FILE_APPEND);
    error_log($data);
    $str = implode(",", $pfData);
    error_log($str);

    foreach( $pfData as $key => $val ) {
        $pfData[$key] = stripslashes( $val );
    }
    
    $pfParamString = "";
    // Convert posted variables to a string
    foreach( $pfData as $key => $val ) {
        if( $key !== 'signature' ) {
            $pfParamString .= $key .'='. urlencode( $val ) .'&';
        } else {
            break;
        }
    }
    
    $pfParamString = substr( $pfParamString, 0, -1 ); 

    $pfPassphrase = "jt7NOE43FZPn";

    $validTest = pfValidSignature($pfData, $pfParamString, $pfPassphrase);

    error_log($validTest);


    

    echo json_encode(['status' => 'success', 'message' => 'Data received for webhook1']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>