<?php include (_PS_ROOT_DIR_.'/josso-php-inc/josso.php') ?>
<?php


class FrontController extends FrontControllerCore
{
   
    public function init()
    {
    	global  $josso_agent;
        if (!(bool)$this->context->customer->isLogged()==true){

        	if (isset($_GET['mylogout'])) {
        		echo 'logout';
        		exit;
        	}
        	$user = $josso_agent->getUserInSession();
        	$sessionId = $josso_agent->getSessionId();
        	if (isset($user)) {
        		$customer = new Customer();
        		$authentication = $customer->getByEmail($user->getName());
        		if (!$authentication || !$customer->id) {
        			$this->errors[] = Tools::displayError('Authentication failed.');
        		} else {
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
