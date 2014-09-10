<?php
class LoginController extends AppController
{ 
  /* Controller to Login. Username and 
  *password are checked if exists in
  *the database
  */
    public function index()
    {   
        $pos = NULL;
        $user = new User();

        $user->username = Param::get('username');
        $user->password = Param::get('password');
       
       if($_POST)
       {
         try{
        	 $userinfo = $user->authorize($user->username, $user->password);
                $_SESSION['username'] = $userinfo->username;
                $_SESSION['password'] = $userinfo->password;
				header("Location:thread/index");
		        } catch (ValidationException $e) {
                $pos = notify($e->getMessage(),"error");
            } catch (RecordNotFoundException $e) {
                $pos = notify($e->getMessage(),"error");
            }

       } 
		$this->set(get_defined_vars());

    }	

/***Function to add new USER ***/
public function register()
    {   $pos=NULL;
        $add_username = Param::get('username');
        $add_password = Param::get('password');
        $add_name = Param::get('name');
        $add_email = Param::get('email');
    $userinfo = array(
                      'username' => $add_username,
                      'password' => $add_password,
                      'name' => $add_name,
                      'email' => $add_email
                    );
$user = new User();

$user->username = Param::get('username');
$user->password = Param::get('password');
$user->name = Param::get('name');
$user->email = Param::get('email');
$noval=NULL;

if($_POST) {
  foreach ($userinfo as $key => $value) 
  {if (!$value) {
                    $noval++;
                 } 
    else {
           $userinfo['$key'] = $value;
         }
  }

  if (!$noval) {
                try {
                     $a = $user->register($userinfo);
                     $pos=notify("Registration Successful");
                     } 
                     catch (UserExistsException $e) {
                     $pos=notify($e->getMessage(), "error");
                     } catch (ValidationException $e) {
                     $pos=notify($e->getMessage(), "error");
                     }  
                 }  
}
  $this->set(get_defined_vars());
    }
}
