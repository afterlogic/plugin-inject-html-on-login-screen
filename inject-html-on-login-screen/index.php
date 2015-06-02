<?php

class_exists('CApi') or die();

class CInjectHtmlOnLoginScreenPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('api-app-data', 'PluginApiAppData');
	}

	public function Init()
	{
		parent::Init();

		$this->IncludeTemplate('Login_LoginViewModel', 'Login-After-Description', 'templates/include.html');
	}
	
	public function PluginApiAppData($oDefaultAccount, &$aAppData)
	{
		if (isset($aAppData['Auth']) && !$aAppData['Auth'] &&
			isset($aAppData['Plugins']) && is_array($aAppData['Plugins']))
		{
			$aAppData['Plugins']['HtmlOnLoginScreen'] = true;
		}
	}
}

return new CInjectHtmlOnLoginScreenPlugin($this);
