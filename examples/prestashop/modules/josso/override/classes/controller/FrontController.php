<?php include_once  (_PS_ROOT_DIR_.'/josso-php-inc/josso.php') ?>
<?php


class FrontController extends FrontControllerCore
{
   
    public function init()
    {
    	global  $josso_agent;
        if ($josso_agent !=null && !(bool)$this->context->customer->isLogged()==true){

        	$user = $josso_agent->getUserInSession();
        	$sessionId = $josso_agent->getSessionId();
        	if (isset($user)) {
        		$customer = new Customer();
        		$authentication = $customer->getByEmail($user->getName());
        		$error = false;
        		if (!$authentication || !$customer->id) {
        			//$this->errors[] = Tools::displayError('Authentication failed.');
        			$customer->email = $user->getName();
        			$customer->passwd = md5(time()._COOKIE_KEY_);
        			$customer->firstname = $user->getProperty('first_name');
        			$customer->lastname = $user->getProperty('last_name');
        			$customer->is_guest = false;
        			
        			if (!$customer->add()){
        				$error = true;
        				$this->errors[] = Tools::displayError('Failed to create customer.');
        			}
        		}
        		
        		if (!$error){
	        		$this->context->cookie->id_customer = (int)($customer->id);
	        		$this->context->cookie->customer_lastname = $customer->lastname;
	        		$this->context->cookie->customer_firstname = $customer->firstname;
	        		$this->context->cookie->logged = 1;
	        		$customer->logged = 1;
	        		$this->context->cookie->is_guest = $customer->isGuest();
	        		$this->context->cookie->passwd = $customer->passwd;
	        		$this->context->cookie->email = $customer->email;
	        			
	        		$this->context->customer = $customer;
	        		Hook::exec('actionAuthentication', array('customer' => $this->context->customer));
        		}
        		

        		
        	}else{
        
        	}
        }
          
        parent::init();
        
        $this->context->smarty->assign(array( 'josso_url'			  => jossoCreateLoginUrl(),));
       
    }

   
}
