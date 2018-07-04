<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/redirectToQlik', 'HomeController@redirectToQlik')->name('redirectToQlik');

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('qlik', function() {
  /*==========================================================================================================

      getticket.php
      -------------
      Function                    : This php file is providing ticket for Authenticated user from External Portal

      First Creation                : Qlik Help
      CURL Programming            : 20180516 - Khrisanto - DSI (credits for making this works !)
      Comments                    : 20180516 - Yusfi - DSI

  ===========================================================================================================*/

  //== Get POST parameter values USER_ID & USER_DIRECTORY
  //$userdir = $_POST["userdir"];
  //$userid = $_POST["userid"];

  //== Define Qlik Proxy Service URL API services
  // Syntax : https://<qliksense server> : <port qps> / <virtual proxy>
  $virtual_proxy    = 'dashboard'; // Qlik Sense Virtual Proxy
  $proxyRestUri     = 'https://52.221.249.56:4243/qps/' . $virtual_proxy;

  //== Define Target Redirection after Getting QLIK Tickets
  $QlikTargetURL     = 'https://52.221.249.56/'.$virtual_proxy.'/hub';
  //    echo $QlikTargetURL;
  //== Define XREF key for Internal mandatory required Attributes
  $url = $proxyRestUri . '/ticket?Xrfkey=1234567890abcdef';

  //== Define the PATH for Qlik Sense SSL Certificates
  //
  // Please Note that Qlik Sense certificate must be exported to WIndows PFX first and then converted manually to PEM with OPENSSL for CURL works.
  // Using : openssl pkcs12 -in client.pfx -out client.pem –nodes
  //----------------------------------------------------------------------------------------------------------------------------------------------
  $cert_file = public_path() . '/client.pem';
  //----------------------------------------------------------------------------------------------------------------------------------------------

  //== Define Passed Parameter for User Authenticated
  $req_fields = array(
   'UserDirectory' => 'win-6k532ka015c',
   'UserId' => 'Administrator',
   'Attributes' => array()
  );

  //== Define Internal Repository User for Access directly to QPS API
  $internal_sa = array('UserDirectory: INTERNAL', 'UserId: sa_repository');

  //== Initialize CURL
  $request = curl_init();

  //== Setup CURL Options
  $options                 = array(
      CURLOPT_URL             => $url, // URL to QPS Server
      CURLOPT_SSLCERT         => $cert_file, // SSL Certificates on server
      /*CURLOPT_SSLCERTPASSWD => $cert_password,*/
      CURLOPT_RETURNTRANSFER     => true, // Response back to this file after POST
      CURLOPT_FOLLOWLOCATION     => true, // tell libcurl to follow redirection
      CURLOPT_SSL_VERIFYHOST     => false, // FALSE : Disable SSL Host verification
      CURLOPT_POST            => true, // Request method is POST for CURL
      CURLOPT_POSTFIELDS        => $internal_sa, // Internal SA Repository User that sent to QPS by POST method
      CURLOPT_SSL_VERIFYPEER     => false, // FALSE : Disable Peer Verification
      CURLOPT_HTTPHEADER         => array('X-qlik-xrfkey: 1234567890abcdef', 'Content-Type: application/json'), // Set Custom Header for QPS mandatory required XREF verification
      CURLOPT_POSTFIELDS         => json_encode($req_fields) // Request JSON values to QPS Services
      );

  //== Set multiple options for a cURL transfer
  curl_setopt_array($request , $options);

  //== Execute CURL !
  $response = curl_exec($request);

  //== Close CURL Connection
  curl_close($request);

  //== CURL Error Handling
  if(!$response)
      {
        echo "Curl Error : " . curl_error($request);
      }
  else
      {
        $ticket = json_decode($response, true);
        $redirectURI = "";
        if( strpos($ticket["TargetUri"], '?') !== false )
        {
          $redirectURI = $ticket["TargetUri"] . '?QlikTicket=' . $ticket["Ticket"];
        }
        else
        {
          $redirectURI = $ticket["TargetUri"] . '?QlikTicket=' . $ticket["Ticket"];
        }


      // echo json_encode(array('ticket' => $ticket["Ticket"]));

      }
      // dd($QlikTargetURL . '?QlikTicket=' . $ticket["Ticket"]);
      //== Redirection to QLIK Dashboard Apps once we get the tickets.
      // header('Location: '. $QlikTargetURL . '?QlikTicket=' . $ticket["Ticket"]);
      return redirect()->away($QlikTargetURL . '?QlikTicket=' . $ticket["Ticket"]);



  });
