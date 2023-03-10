<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Payment\Payment;
use Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_id =Auth::guard('admin')->user()->id;
        $orders = Payment::where('parent_id',$parent_id)->get();
        return view('front.payment.payment',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
       {
        $order_id = uniqid();
        $parent_id = Auth::guard('admin')->user()->id;
        $order = new Payment();
        $order->order_id = $order_id;
        $order->parent_id = $parent_id;
        $order->status = 'pending';
        $order->price = ( $request->price ) ? $request->price : '';
        $order->transaction_id = '';
        $order->save();
        $data_for_request = $this->handlePaytmRequest( $order_id, $order->price );
        $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view( 'front.payment.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
       }
    public function handlePaytmRequest( $order_id, $amount ) {
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();
        $checkSum = "";
        $paramList = array();
        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = 'yXNojM90140686906126';
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = 'WEBSTAGING';
        $paramList["CALLBACK_URL"] = url( '/payment/paytm-callback' );
        $paytm_merchant_key = 'zWKZ0oSL5Xvzh82A';
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
        return array(
            'checkSum' => $checkSum,
            'paramList' => $paramList
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
         * Get all the functions from encdec_paytm.php
         */
        function getAllEncdecFunc() {
            function encrypt_e($input, $ky) {
                $key   = html_entity_decode($ky);
                $iv = "@@@@&&&&####$$$$";
                $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
                return $data;
            }
            function decrypt_e($crypt, $ky) {
                $key   = html_entity_decode($ky);
                $iv = "@@@@&&&&####$$$$";
                $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
                return $data;
            }
            function pkcs5_pad_e($text, $blocksize) {
                $pad = $blocksize - (strlen($text) % $blocksize);
                return $text . str_repeat(chr($pad), $pad);
            }
            function pkcs5_unpad_e($text) {
                $pad = ord($text{strlen($text) - 1});
                if ($pad > strlen($text))
                    return false;
                return substr($text, 0, -1 * $pad);
            }
            function generateSalt_e($length) {
                $random = "";
                srand((double) microtime() * 1000000);
                $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
                $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
                $data .= "0FGH45OP89";
                for ($i = 0; $i < $length; $i++) {
                    $random .= substr($data, (rand() % (strlen($data))), 1);
                }
                return $random;
            }
            function checkString_e($value) {
                if ($value == 'null')
                    $value = '';
                return $value;
            }
            function getChecksumFromArray($arrayList, $key, $sort=1) {
                if ($sort != 0) {
                    ksort($arrayList);
                }
                $str = getArray2Str($arrayList);
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function getChecksumFromString($str, $key) {
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function verifychecksum_e($arrayList, $key, $checksumvalue) {
                $arrayList = removeCheckSumParam($arrayList);
                ksort($arrayList);
                $str = getArray2StrForVerify($arrayList);
                $paytm_hash = decrypt_e($checksumvalue, $key);
                $salt = substr($paytm_hash, -4);
                $finalString = $str . "|" . $salt;
                $website_hash = hash("sha256", $finalString);
                $website_hash .= $salt;
                $validFlag = "FALSE";
                if ($website_hash == $paytm_hash) {
                    $validFlag = "TRUE";
                } else {
                    $validFlag = "FALSE";
                }
                return $validFlag;
            }
            function verifychecksum_eFromStr($str, $key, $checksumvalue) {
                $paytm_hash = decrypt_e($checksumvalue, $key);
                $salt = substr($paytm_hash, -4);
                $finalString = $str . "|" . $salt;
                $website_hash = hash("sha256", $finalString);
                $website_hash .= $salt;
                $validFlag = "FALSE";
                if ($website_hash == $paytm_hash) {
                    $validFlag = "TRUE";
                } else {
                    $validFlag = "FALSE";
                }
                return $validFlag;
            }
            function getArray2Str($arrayList) {
                $findme   = 'REFUND';
                $findmepipe = '|';
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    $pos = strpos($value, $findme);
                    $pospipe = strpos($value, $findmepipe);
                    if ($pos !== false || $pospipe !== false)
                    {
                        continue;
                    }
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function getArray2StrForVerify($arrayList) {
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function redirect2PG($paramList, $key) {
                $hashString = getchecksumFromArray($paramList, $key);
                $checksum = encrypt_e($hashString, $key);
            }
            function removeCheckSumParam($arrayList) {
                if (isset($arrayList["CHECKSUMHASH"])) {
                    unset($arrayList["CHECKSUMHASH"]);
                }
                return $arrayList;
            }
            function getTxnStatus($requestParamList) {
                return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
            }
            function getTxnStatusNew($requestParamList) {
                return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
            }
            function initiateTxnRefund($requestParamList) {
                $CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
                $requestParamList["CHECKSUM"] = $CHECKSUM;
                return callAPI(PAYTM_REFUND_URL, $requestParamList);
            }
            function callAPI($apiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($postData))
                );
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
            function callNewAPI($apiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($postData))
                );
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
            function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
                if ($sort != 0) {
                    ksort($arrayList);
                }
                $str = getRefundArray2Str($arrayList);
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function getRefundArray2Str($arrayList) {
                $findmepipe = '|';
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    $pospipe = strpos($value, $findmepipe);
                    if ($pospipe !== false)
                    {
                        continue;
                    }
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function callRefundAPI($refundApiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_URL, $refundApiURL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
        }
        /**
         * Config Paytm Settings from config_paytm.php file of paytm kit
         */
        function getConfigPaytmSettings() {
            define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
            define('PAYTM_MERCHANT_KEY', 'zWKZ0oSL5Xvzh82A'); //Change this constant's value with Merchant key downloaded from portal
            define('PAYTM_MERCHANT_MID', 'yXNojM90140686906126'); //Change this constant's value with MID (Merchant ID) received from Paytm
            define('PAYTM_MERCHANT_WEBSITE', 'www.mailin.co.in'); //Change this constant's value with Website name received from Paytm
            $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
            if (PAYTM_ENVIRONMENT == 'PROD') {
                $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
                $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
            }
            define('PAYTM_REFUND_URL', '');
            define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
        }
        public function paytmCallback( Request $request ) {
            $order_id = $request['ORDERID'];  
            if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
                $transaction_id = $request['TXNID'];
                $order = Payment::where( 'order_id', $order_id )->first();
                $order->status = 'complete';
                $order->transaction_id = $transaction_id;
                $order->save();
                return redirect()->route('payment.form')->with(['message'=>'Payment Successfully','class'=>'success']);
            } else if( 'TXN_FAILURE' === $request['STATUS'] ){
                return redirect()->route('payment.form')->with(['message'=>'Payment Failed','class'=>'success']);
            }else if( 'PENDING' === $request['STATUS'] ){
                return redirect()->route('payment.form')->with(['message'=>'Payment Pending','class'=>'success']);
            }
        }
}
