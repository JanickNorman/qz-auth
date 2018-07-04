<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $this->validateLogin($request);

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }

      if ($this->attemptLogin($request)) {
        //   dd("Hello " . \Auth::user()->name . "!");
        // /*==========================================================================================================
        //
        // 	getticket.php
        // 	-------------
        // 	Function					: This php file is providing ticket for Authenticated user from External Portal
        //
        // 	First Creation				: Qlik Help
        // 	CURL Programming			: 20180516 - Khristanto - DSI (credits for making this works !)
        // 	Comments					: 20180516 - Yusfi - DSI
        //
        // ===========================================================================================================*/

        //== Get POST parameter values USER_ID & USER_DIRECTORY
        $userdir ="win-6k532ka015c";
        $userid = "ADMINISTRATOR";

        //== Define Qlik Proxy Service URL API services
        // Syntax : https://<qliksense server> : <port qps> / <virtual proxy>
        $virtual_proxy	= 'dashboard'; // Qlik Sense Virtual Proxy
        $proxyRestUri 	= 'https://52.221.249.56/hub/' . $virtual_proxy;

        //== Define Target Redirection after Getting QLIK Tickets
        // $QlikTargetURL 	= 'https://qliksense/bcaphp/hub';
        $QlikTargetURL 	= 'https://52.221.249.56/dashboard/hub';

        //== Define XREF key for Internal mandatory required Attributes
        $url = $proxyRestUri . '/ticket?Xrfkey=1234567890abcdef';

        //== Define the PATH for Qlik Sense SSL Certificates
        //
        // Please Note that Qlik Sense certificate must be exported to WIndows PFX first and then converted manually to PEM with OPENSSL for CURL works.
        // Using : openssl pkcs12 -in client.pfx -out client.pem –nodes
        //----------------------------------------------------------------------------------------------------------------------------------------------
        //$cert_file = 'c:\cert\client.pem';
        $cert_file = public_path().'/client.pem';
        // dd(public_path().'/client.pem');
        //----------------------------------------------------------------------------------------------------------------------------------------------

        //== Define Passed Parameter for User Authenticated
        $req_fields = array(
          'UserDirectory' => $userdir,
          'UserId' => $userid,
          'Attributes' => array()
        );

        //== Define Internal Repository User for Access directly to QPS API
        $internal_sa = array('UserDirectory: INTERNAL', 'UserId: sa_repository');

        //== Initialize CURL
        $curl_request = curl_init();

        //== Setup CURL Options
        $options 				= array(
        	CURLOPT_URL 			=> $url, // URL to QPS Server
        	CURLOPT_SSLCERT 		=> $cert_file, // SSL Certificates on server
        	/*CURLOPT_SSLCERTPASSWD => $cert_password,*/
        	CURLOPT_RETURNTRANSFER 	=> true, // Response back to this file after POST
        	CURLOPT_FOLLOWLOCATION 	=> true, // tell libcurl to follow redirection
        	CURLOPT_SSL_VERIFYHOST 	=> false, // FALSE : Disable SSL Host verification
        	CURLOPT_POST			=> true, // Request method is POST for CURL
        	CURLOPT_POSTFIELDS		=> $internal_sa, // Internal SA Repository User that sent to QPS by POST method
        	CURLOPT_SSL_VERIFYPEER 	=> false, // FALSE : Disable Peer Verification
        	CURLOPT_HTTPHEADER 		=> array('X-qlik-xrfkey: 1234567890abcdef', 'Content-Type: application/json'), // Set Custom Header for QPS mandatory required XREF verification
        	CURLOPT_POSTFIELDS 		=> json_encode($req_fields) // Request JSON values to QPS Services
        	);

        //== Set multiple options for a cURL transfer
        curl_setopt_array($curl_request , $options);

        //== Execute CURL !
        $response = curl_exec($curl_request);

        //== Close CURL Connection
        curl_close($curl_request);

        //== CURL Error Handling
        if(!$response)
        	{
        	  echo "Curl Error : " . curl_error($curl_request);
        	}
        else
        	{
        	  $ticket = json_decode($response, true);
        	  $redirectURI = "";
        	  if( strpos($ticket["TargetUri"], '?') !== false )
        	  {
        		$redirectURI = $ticket["TargetUri"] . '&QlikTicket=' . $ticket["Ticket"];
        	  }
        	  else
        	  {
        		$redirectURI = $ticket["TargetUri"] . '?QlikTicket=' . $ticket["Ticket"];
        	  }


        	// echo json_encode(array('ticket' => $ticket["Ticket"]));

        	}

        	//== Redirection to QLIK Dashboard Apps once we get the tickets.
        	header('Location: '. $QlikTargetURL . '&QlikTicket=' . $ticket["Ticket"]);

          return $this->sendLoginResponse($request);
          // return redirect()->route('redirectToQlik');
      }

      // If the login attempt was unsuccessful we will increment the number of attempts
      // to login and redirect the user back to the login form. Of course, when this
      // user surpasses their maximum number of attempts they will get locked out.
      $this->incrementLoginAttempts($request);

      return $this->sendFailedLoginResponse($request);
    }

}
