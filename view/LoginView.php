<?php

session_start();

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() 
	{
		
		// checks username and password input
		
		$message = '';
		$response = '';
		
		if(isset($_POST[self::$name]) || isset($_POST[self::$password])) 
		{
			if($_POST[self::$name] == '')
			{
				$message = 'Username is missing';
			}
			else if($_POST[self::$password] == '')
			{
				$message = 'Password is missing';
			}
			// om man inte har rätt inlogg
			else 
			{
				$message = 'Wrong name or password';
			}
			// if the username is Admin and the password is Password you get logged in
			
			if ($_POST[self::$password] == 'Password' && $_POST[self::$name] =='Admin')
			{
				//loggas in
				$message = 'Welcome';
				//sessions
				$_SESSION['Username'] = $_POST[self::$password];
				$_SESSION['Password'] = $_POST[self::$name];
				//visar log ut knappen
				$response = $this->generateLogoutButtonHTML($message);	
				return $response;
			}
			
		}
		$response = $this->generateLoginFormHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) 
	{
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
		
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		if(isset($_SESSION['Username']))
		unset($_SESSION['Username']);  
		return '
			<form method="post" name="form" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					
					
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />


				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() 
	{
		//RETURN REQUEST VARIABLE: USERNAME
	
	}
	
}