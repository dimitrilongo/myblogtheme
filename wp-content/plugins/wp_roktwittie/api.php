<?php
/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright © 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

define('WP_USE_THEMES', false);
$path = $_SERVER['SCRIPT_FILENAME'];
$path = str_replace('wp-content/plugins/wp_roktwittie/api.php', '', $path);
require_once($path . 'wp-blog-header.php');

global $roktwittie_plugin_url;

// definitions
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// initialise session
if(!session_id()) $session = session_start();

// build parameters object
$params = get_option('roktwittie_options');
$cmd = $_GET['task'];
$cmd = (string) preg_replace('/[^A-Z0-9_\.-]/i', '', $cmd);
$cmd = ltrim($cmd, '.');

switch ($cmd) {
	case 'redirect':
		// twitter OAuth object
		$connection = RokTwittiePlugin::getOauth($params, '', '');
		
		// consumer keys weren't configured
		if (!$connection) {
			redirectToEdit(__('Consumer keys are not configured.', 'roktwittie'));
		}
		
		// get temporary credentials
		$url = $roktwittie_plugin_url . "/api.php?task=callback&cid=roktwittie";
		$request_token = @$connection->getRequestToken($url);
		
		if (!is_array($request_token) || !isset($request_token['oauth_token']) || !isset($request_token['oauth_token_secret'])) {
			error();
		}

		// save temporary credentials to session
		roktwittie_setInSession('oauth_token', $token = $request_token['oauth_token']);
		roktwittie_setInSession('oauth_token_secret', $request_token['oauth_token_secret']);
		 
		// if last connection failed don't display authorization link
		switch ($connection->http_code) {
		  case 200:
			// build authorize URL and ...
			$url = $connection->getAuthorizeURL($token);
			// ... redirect user to Twitter
			header('Location: ' . $url); 
			break;
		  default:
			error();
		}
			
		break;

	case 'callback':
		// if the oauth_token is old redirect to the connect page
		if (isset($_REQUEST['oauth_token']) && roktwittie_getFromSession('oauth_token') !== $_REQUEST['oauth_token']) {
		  roktwittie_setInSession('oauth_status', 'oldtoken');
		  error();
		}

		// create TwitteroAuth object with app key/secret and token key/secret from default phase
		$connection = RokTwittiePlugin::getOauth($params, roktwittie_getFromSession('oauth_token'), roktwittie_getFromSession('oauth_token_secret'));

		// request access tokens from twitter
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		
		// check if token was successfully returned
		if (!is_array($access_token) || !isset($access_token['oauth_token']) || !isset($access_token['oauth_token_secret'])) {
			error();
		}
		
		// update params
		$params['oauth_token'] = $access_token['oauth_token'];
		$params['oauth_token_secret'] = $access_token['oauth_token_secret'];
		update_option('roktwittie_options', $params);
		
		// remove no longer needed request tokens
		roktwittie_clearFromSession('oauth_token');
		roktwittie_clearFromSession('oauth_token_secret');

		// if HTTP response is 200 continue otherwise something went wrong
		if (200 == $connection->http_code) {
			// the user has been verified and the access tokens can be saved for future use
			redirectToEdit(__('RokTwittie has been successfully authenticated with Twitter.', 'roktwittie'));
		} else {
			error();
		}
		break;
		
	default:
		error(__('Restricted access', 'roktwittie'));
		break;
}

function error() {
	$message = __('Could not connect to Twitter. Refresh the page or try again later.', 'roktwittie');
	die($message);
}

function redirectToEdit($message = null) {
    header('Location: ' . get_bloginfo('wpurl') . '/wp-admin/plugins.php?page=roktwittie-settings&message=' . urlencode($message));
}

function roktwittie_setInSession($name, $value = null, $namespace = 'wp_roktwittie') {
	$old = isset($_SESSION[$namespace][$name]) ? $_SESSION[$namespace][$name] : null;

	if (null === $value)
	{
		unset($_SESSION[$namespace][$name]);
	}
	else
	{
		$_SESSION[$namespace][$name] = $value;
	}

	return $old;
}

function roktwittie_getFromSession($name, $default = null, $namespace = 'wp_roktwittie') {
	if (isset($_SESSION[$namespace][$name]))
	{
		return $_SESSION[$namespace][$name];
	}
	return $default;
}

function roktwittie_clearFromSession($name, $namespace = 'wp_roktwittie') {
	$value = null;
	if (isset($_SESSION[$namespace][$name]))
	{
		$value = $_SESSION[$namespace][$name];
		unset($_SESSION[$namespace][$name]);
	}

	return $value;
}