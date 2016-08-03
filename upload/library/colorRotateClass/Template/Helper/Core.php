<?php
class colorRotateClass_Template_Helper_Core extends XenForo_Template_Helper_Core
{
	public static $overridenHelperCallbacks = array(
		'username'          => array(null, array('colorRotateClass_Template_Helper_Core', 'helperUserName')),
		'usertitle'         => array(null, array('colorRotateClass_Template_Helper_Core', 'helperUserTitle')),
		'richusername'      => array(null, array('colorRotateClass_Template_Helper_Core', 'helperRichUserName')),
		'userblurb'         => array(null, array('colorRotateClass_Template_Helper_Core', 'helperUserBlurb')),
		'usernamehtml'      => array(null, array('colorRotateClass_Template_Helper_Core', 'helperUserNameHtml')),
		); /* First position of inner arrays (null) are going to be replaced in runtime */
		
		
	public static function callOldHelper($helper, array $args)
	{
		$helper = strtolower(strval($helper));
		// If uninitialized or reference lost...
		if (!isset( self::$overridenHelperCallbacks[$helper]) ||
			!isset( self::$overridenHelperCallbacks[$helper][0]) ||
			is_null(self::$overridenHelperCallbacks[$helper][0]))
		{
			// ...ignore because other add-on messed up with this one.
			return '';
		}
		return call_user_func_array(self::$overridenHelperCallbacks[$helper][0], $args);
	}
	
	public static function helperUserBlurb(array $user, $includeUserTitle = true){
		//First we call the old helper
		$res = self::callOldHelper('userblurb',func_get_args());
		//Then we adjust its output
		$encapuslate = false;
		$find = 'class="userTitle';
		$utclass = self::helperUserTitleAnimationCss($user['user_id']);
		if($utclass){
			$utclass = ' '.$utclass.' ';
			$res = colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass);
			if($encapuslate){
				$res='<span class="'.$utclass.'">'.$res.'</span>';
			}
		}
		//Finally we return it
		return $res;
	}
	
	public static function helperUserTitle($user, $allowCustomTitle = true, $withBanner = false){
		//First we call the old helper
		$res = self::callOldHelper('usertitle',func_get_args());
		//Then we adjust its output
		$encapuslate = true;
		$find = 'class="';
		$utclass = self::helperUserTitleAnimationCss($user['user_id']);
		if($utclass){
			$utclass = ' '.$utclass.' ';
			$res = colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass);
			if($encapuslate){
				$res='<span class="'.$utclass.'">'.$res.'</span>';
			}
		}
		//Finally we return it
		return $res;
	}
	
	public static function helperRichUserName(array $user, $usernameHtml = ''){
		//First we call the old helper
		$res = self::callOldHelper('richusername',func_get_args());
		//Then we adjust its output
		$encapuslate = false;
		$find = 'class="';
		$utclass = self::helperUserNameAnimationCss($user['user_id']);
		if($utclass){
			$utclass = ' '.$utclass.' ';
			$res = colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass);
			if($encapuslate){
				$res='<span class="'.$utclass.'">'.$res.'</span>';
			}
		}
		//Finally we return it
		return $res;
	}
	
	public static function helperUserName(array $user, $class = '', $rich = false){
		//First we call the old helper
		$res = self::callOldHelper('username',func_get_args());
		//Then we adjust its output
		$encapuslate = false;
		$find = 'class="';
		$utclass = self::helperUserNameAnimationCss($user['user_id']);
		if($utclass){
			$utclass = ' '.$utclass.' ';
			$res = colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass);
			if($encapuslate){
				$res='<span class="'.$utclass.'">'.$res.'</span>';
			}
		}
		//Finally we return it
		return $res;
	}
	
	public static function helperUserNameHtml(array $user, $username = '', $rich = false, array $attributes = array()){
		//First we call the old helper
		$res = self::callOldHelper('usernamehtml',func_get_args());
		//Then we adjust its output
		$encapuslate = true;
		$find = 'class="';
		$utclass = self::helperUserNameAnimationCss($user['user_id']);
		if($utclass){
			$utclass = ' '.$utclass.' ';
			//die(print_r(array($res,colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass)),true));
			$res = colorRotateClass_strTools::str_findFirst_appendAfter($res, $find, $utclass);
			if($encapuslate){
				$res='<span class="'.$utclass.'">'.$res.'</span>';
			}
		}
		//Finally we return it
		return $res;
	}
	
	public static $UserNameAnimationCssClass = array(null,'hue_animated_1s','hue_animated_2s','hue_animated_3s');
	public static $UserTitleAnimationCssClass = array(null,'hue_animated_1s','hue_animated_2s','hue_animated_3s');
	
	public static function helperUserNameAnimationCss($user_id){
		//return self::$UserNameAnimationCssClass[0];
		$css = 0;
		$permissionChecker = colorRotateClass_Permission::getInstance();
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsername3s')){
			$css = 3;
		}
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsername2s')){
			$css = 2;
		}
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsername1s')){
			$css = 1;
		}
		return self::$UserNameAnimationCssClass[$css];
	}
	
	public static function helperUserTitleAnimationCss($user_id){
		//return self::$UserTitleAnimationCssClass[0];
		$css = 0;
		try{
		$permissionChecker = colorRotateClass_Permission::getInstance();
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsertitle3s')){
			$css = 3;
		}
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsertitle2s')){
			$css = 2;
		}
		if($permissionChecker->userHasPermission($user_id, 'colorRotateGrp', 'colorRotateUsertitle1s')){
			$css = 1;
		}
		}catch(Error $e){die(print_r($e,true));}
		return self::$UserTitleAnimationCssClass[$css];
	}
}
