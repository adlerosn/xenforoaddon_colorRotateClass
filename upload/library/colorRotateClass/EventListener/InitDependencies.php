<?php

class colorRotateClass_EventListener_InitDependencies{
	public static function listen(XenForo_Dependencies_Abstract $dependencies, array $data){
		//Overloading by setting the current definiton to call later
		foreach(colorRotateClass_Template_Helper_Core::$overridenHelperCallbacks as $k=>$v){
			$originalCallback = XenForo_Template_Helper_Core::$helperCallbacks[$k];
			if($originalCallback[0]=='colorRotateClass_Template_Helper_Core'){
				continue; // Some other add-on is calling this twice... maybe some mess was done and it wasn't fully reverted; not my fault... ignore and continue.
			}
			if($originalCallback[0]=='self'){
				$originalCallback[0]='XenForo_Template_Helper_Core';
			}
			colorRotateClass_Template_Helper_Core::$overridenHelperCallbacks[$k][0]=$originalCallback;
			XenForo_Template_Helper_Core::$helperCallbacks[$k]=colorRotateClass_Template_Helper_Core::$overridenHelperCallbacks[$k][1];
		}
		//New helper definitions
		XenForo_Template_Helper_Core::$helperCallbacks['usernamehueanimationcss'] = array('colorRotateClass_Template_Helper_Core', 'helperUserNameAnimationCss');
		XenForo_Template_Helper_Core::$helperCallbacks['usertitlehueanimationcss'] = array('colorRotateClass_Template_Helper_Core', 'helperUserTitleAnimationCss');
		return;
	}
}
