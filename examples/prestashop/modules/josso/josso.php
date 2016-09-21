<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (!defined('_PS_VERSION_'))
	exit;

class Josso extends Module{
	
	public function __construct()
	{
		$this->name = 'josso';
		$this->version = '1.0.0';
		$this->author = 'Athirat';
		$this->need_instance = 0;
	
		$this->controllers = array('default');
	
		$this->bootstrap = true;
		parent::__construct();
	
		$this->displayName = $this->l('Josso and Prestashop Integration');
		$this->description = $this->l('Provide SSO connect via JOSSO platform');
		$this->confirmUninstall = $this->l('Are you sure you want to delete all josso points and customer history?');
	}
	
	public function install()
	{
		return parent::install() && $this->registerHook('actionCustomerLogoutAfter');
	}
	

	public function hookActionCustomerLogoutAfter($params){
		forceRedirect(jossoCreateLogoutUrl(null));
	}
}