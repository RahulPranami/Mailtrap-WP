<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rahulpranami.co
 * @since      1.0.0
 *
 * @package    Mailtrap
 * @subpackage Mailtrap/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mailtrap
 * @subpackage Mailtrap/admin
 * @author     Rahul Pranami <rahulpranami101@gmail.com>
 */
class Mailtrap_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hooks ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mailtrap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mailtrap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mailtrap-admin.css', array(), $this->version, 'all' );


		// print_r($hooks);
		if ('toplevel_page_mailtrap' === $hooks) {
			wp_enqueue_style( 'tailwindcss', plugin_dir_url( __FILE__ ) . 'partials/tailwindcss.css', array(), microtime(), 'all' );
			// wp_enqueue_style( 'tailwindcss', plugin_dir_url( __FILE__ ) . 'partials/tailwindcss.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hooks ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mailtrap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mailtrap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mailtrap-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'htmx', plugin_dir_url( __FILE__ ) . 'js/htmx.min.js', array(), $this->version, false );
		wp_enqueue_script( 'mailtrap-admin-settings', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

	public function mailtrap_page() {
		add_menu_page('Mailtrap', 'Mailtrap', 'manage_options', 'mailtrap', function () {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/mailtrap-admin-display.php';
		}, 'dashicons-email-alt', 90);
	}

	public function register_mailtrap_settings() {
		register_setting('mailtrap-settings', 'mailtrap_enabled');
		register_setting('mailtrap-settings', 'mailtrap_port');
		register_setting('mailtrap-settings', 'mailtrap_username');
		register_setting('mailtrap-settings', 'mailtrap_password');
		register_setting('mailtrap-settings', 'mailtrap_secure');
		register_setting('mailtrap-settings', 'mailtrap_api_token');
		register_setting('mailtrap-settings', 'mailtrap_from_email');
	}

	function mailtrap($phpmailer) {
		$phpmailer->isSMTP();
		$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = 2525;
		$phpmailer->Username = '337528edd519a1';
		$phpmailer->Password = '5ad2c519903086';
	}

	public function send_test_mail()
	{
		global $wpdb;

		// print_r($_POST);
		$curl = curl_init();


		$from_email = get_option('mailtrap_from_email');
		$to_email = $_POST['to_email'];
		// $email_sent = null;
		$emailBody = "This is Example Mail";

		// require_once ABSPATH . WPINC . '/class-phpmailer.php';

		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host       = 'sandbox.smtp.mailtrap.io'; // e.g., 'live.smtp.mailtrap.io'
		$mail->SMTPAuth   = true;
		$mail->Username   = '337528edd519a1'; // Mailtrap API username
		$mail->Password   = '5ad2c519903086'; // Mailtrap API password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port       =  587; // Mailtrap SMTP port

		// Set the email details
		$mail->setFrom($from_email, "Mailtrap for Wordpress");
		$mail->addAddress($to_email);
		$mail->Subject = "Test Email";
		$mail->Body    = $emailBody;

		// Try to send the email
		if (!$mail->send()) {
			error_log("Mailtrap SMTP Error: {$mail->ErrorInfo}");
			echo "Mailtrap SMTP Error: {$mail->ErrorInfo}";
			return false;
		} else {
			echo "Mailtrap Successfully Send Email";
			return true;
		}

			    // if($_SERVER['REQUEST_METHOD'] == 'POST')
			    // {
			    // //   if (!wp_verify_nonce( $_POST['_wpnonce'], 'mailtrap_test_action' ) ) {
			    // //     die( 'Failed security check' );
			    // //   }

			    //   $email_sent = wp_mail( $_POST['to_email'], __( 'Mailtrap for Wordpress Plugin', 'mailtrap-for-wp' ), $emailBody);

				//   print_r($email_sent);
			    // }

// 		$curl = curl_init();
// 		$emailBody = "This is Example Mail";

// print_r($emailBody);
// // exit();
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, 'smtp://sandbox.smtp.mailtrap.io:2525');
// 		curl_setopt($ch, CURLOPT_USERNAME, '337528edd519a1');
// 		curl_setopt($ch, CURLOPT_PASSWORD, '5ad2c519903086');
// 		curl_setopt($ch, CURLOPT_MAIL_FROM, $from_email);
// 		curl_setopt($ch, CURLOPT_MAIL_RCPT, [$to_email]);
// 		curl_setopt($ch, CURLOPT_UPLOAD, 1);
// 		curl_setopt($ch, CURLOPT_INFILE, fopen('php://memory', 'rw+'));
// 		curl_setopt($ch, CURLOPT_INFILESIZE, strlen($emailBody));
// 		// curl_setopt($ch, CURLOPT_READFUNCTION, function ($ch, $fd, $length) {
// 		// 	error_log("161 : " . print_r($fd, true));
// 		// 	// $data = substr($emailBody, 0, $length);
// 		// 	// $emailBody = substr($emailBody, $length);
// 		// 	return $fd;
// 		// });
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for testing purposes

// 		$response = curl_exec($ch);

// 		if (curl_errno($ch)) {
// 			print_r("172 : " . curl_error($ch));

// 			throw new Exception(curl_error($ch));
// 		}

// 		print_r($response);

// 		curl_close($ch);


		// curl_setopt($curl, CURLOPT_URL, "smtp://sandbox.smtp.mailtrap.io:2525");
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// smtp://sandbox.smtp.mailtrap.io:2525

		// curl_setopt_array($curl, [
		// 	CURLOPT_URL => "https://stoplight.io/mocks/railsware/mailtrap-api-docs/93404133/api/send",
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => "",
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 30,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => "POST",
		// 	CURLOPT_POSTFIELDS => json_encode([
		// 		'to' => [
		// 			[
		// 				'email' => $to_email
		// 			]
		// 		],
		// 		'from' => [
		// 			'email' => $from_email
		// 		],
		// 		'attachments' => [
		// 			[
		// 				'content' => 'PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuIj4KCiAgICA8aGVhZD4KICAgICAgICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+CiAgICAgICAgPG1ldGEgaHR0cC1lcXVpdj0iWC1VQS1Db21wYXRpYmxlIiBjb250ZW50PSJJRT1lZGdlIj4KICAgICAgICA8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCI+CiAgICAgICAgPHRpdGxlPkRvY3VtZW50PC90aXRsZT4KICAgIDwvaGVhZD4KCiAgICA8Ym9keT4KCiAgICA8L2JvZHk+Cgo8L2h0bWw+Cg==',
		// 				'filename' => 'index.html',
		// 				'type' => 'text/html',
		// 				'disposition' => 'attachment'
		// 			]
		// 		],
		// 		'custom_variables' => [
		// 			'user_id' => '45982',
		// 			'batch_id' => 'PSJ-12'
		// 		],
		// 		'headers' => [
		// 			'X-Message-Source' => 'dev.mydomain.com'
		// 		],
		// 		'subject' => 'Your Example Order Confirmation',
		// 		'text' => 'Congratulations on your order no. 1234',
		// 		'category' => 'API Test'
		// 	]),
		// 	CURLOPT_HTTPHEADER => [
		// 		"Accept: application/json",
		// 		"Api-Token: ${get_option('mailtrap_api_token')}",
		// 		"Content-Type: application/json"
		// 	],
		// ]);

		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);

		// if ($err) {
		// 	echo "cURL Error #:" . $err;
		// } else {
		// 	echo $response;
		// }

		ob_start();
		?>
				<div class="notice notice-success is-dismissible">
					<p>
						<?php echo __('Your email has been sent successfully', 'mailtrap-for-wp') ?>
					</p>
				</div>
		<?php
		echo ob_get_clean();
		exit();
	}

}
