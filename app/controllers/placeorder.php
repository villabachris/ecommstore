<?php 
session_start();
require_once('./connect.php');

//Load Composer's autoloader
require '../../vendor/autoload.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// required paypal classes
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require "./paypal/start.php";




function generate_new_transaction_number(){
	$ref_number= '';

	$source = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');


	for($i=0;$i<16;$i++){
		$index= rand(0,35);//generates a random number from 0-15

		//append random character
		$ref_number.=$source[$index];
	}
	$today=getdate();
	return $ref_number.'-'.$today[0];//seconds since Unix epoch
}
	//get all the details of the order
	$user_id = $_SESSION['user']['id'];
	$purchase_date = date('Y-m-d G:i:s');//G is for 12 hour format, i = minutes with leading zeros, s seconds with leading zeros
	$status_id=1;	
	$payment_mode_id=$_POST['payment_mode'];
	$address=$_POST['addressLine1'];

	if ($payment_mode_id == 1) {
		
	$transaction_number= generate_new_transaction_number();
	$_SESSION['new_txn_number'] = $transaction_number;

	//create a new order
	$sql = "INSERT INTO orders(user_id,transaction_code,purchase_date,status_id,payment_mode_id) VALUES('$user_id','$transaction_number','$purchase_date','$status_id','$payment_mode_id')";
	$result = mysqli_query($conn, $sql);
	//get the latest order ID to associate items for orders_item table
	$new_order_id= mysqli_insert_id($conn);

	//if order was created
	if($result){
		//loop through to the items inside session cart
		foreach($_SESSION['cart'] as $item_id => $qty){
			//get price of the current item
			$sql= "SELECT price FROM items WHERE id = '$item_id'";
			$result= mysqli_query($conn, $sql);

			//fetch the data from query
			$item= mysqli_fetch_assoc($result);

		}
	}
	//clear items from cart
	$_SESSION['cart'] = [];
	
	
// Send email notification to customer
// ==============================================================================




$mail = new PHPMailer(true); 
// Passing `true` enables exceptions

$staff_email = 'ecommstore123@gmail.com';
$customer_email = $_SESSION['user']['email'];          //
$subject = 'Ecommstore - Order Confirmation';
$body ="<div style='background-color:blue;color:white;text-align:center;height:50px'><h1>Ecomm Store</h1></div>
		<div style='background-color:yellow;height:10px'></div>
		<div style='background-color:#f2f2f2;'><h2 style='margin-top:0'>Reference No.:".$transaction_number."</h2>
		<hr>

		</div>";
echo $body;
exit();
try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $staff_email;                       // SMTP username
    $mail->Password = 'thoperio1990';                     // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($staff_email, 'ecommstore');
    $mail->addAddress($customer_email);  // Name is optional

    //Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Route user to confirmation page
    
    header('location: ../views/confirmation.php');

    $mail->send();
    echo 'Message has been sent';

	} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}

	mysqli_close($conn);

}else{
	$_SESSION['address'] = $_POST['addressLine1'];
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $total = 0;
    $items = [];
    foreach($_SESSION['cart'] as $id => $quantity){
        $sql = "SELECT * FROM items WHERE id =$id";
        $result = mysqli_query($conn, $sql);
        $item = mysqli_fetch_assoc($result);
        extract($item);
        $total += $price*$quantity;
        $indiv_item = new Item();
        $indiv_item->setName($name)
                ->setCurrency('PHP')
                ->setQuantity($quantity)
                ->setPrice($price);
        $items[] = $indiv_item;        
    }

    $item_list = new ItemList();
    $item_list->setItems($items);

    $amount = new Amount();
    $amount->setCurrency("PHP")
        ->setTotal($total);

    $transaction = new Transaction();
    $transaction ->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Payment for Ecommstore Purchase')
                ->setInvoiceNumber(uniqid("Ecommstore_"));

    $redirectUrls = new RedirectUrls();
    $redirectUrls
        ->setReturnUrl('https://ecommstore123.herokuapp.com/app/controllers/pay.php?success=true')
        ->setCancelUrl('https://ecommstore123.herokuapp.com/app/controllers/pay.php?success=false');

    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

    try{
        $payment->create($paypal);
    } catch(Exception $e){
        die($e->getData());
    }

    $approvalUrl = $payment->getApprovalLink();
    header('location: '.$approvalUrl);    


}

 ?>
