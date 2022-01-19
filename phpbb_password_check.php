<?php

//the $password & $pw_hash variables below are hard coded for quick testing purposes.
//I, for example, have local dev board with a user named 335forum & password 335forum. 
//$pw_hash is from phpbb database's user_password column in users table
$password = '335forum';
$pw_hash = '$argon2id$v=19$m=65536,t=4,p=2$SlBGTkIvaVhrcFZCUWlSag$z7zLTWtOx2MYD/rsL9g9FDp6okbs+zrl4vnk40eBKmM';

//include required classes...
require_once('./phpbb/config/config.php');
require_once('./phpbb/passwords/helper.php');
require_once('./phpbb/passwords/driver/helper.php');
require_once('./phpbb/passwords/driver/driver_interface.php');
require_once('./phpbb/passwords/driver/rehashable_driver_interface.php');
require_once('./phpbb/passwords/manager.php');
require_once('./phpbb/passwords/driver/base.php');
require_once('./phpbb/passwords/driver/base_native.php');
require_once('./phpbb/passwords/driver/bcrypt.php');
require_once('./phpbb/passwords/driver/bcrypt_2y.php');
require_once('./phpbb/passwords/driver/salted_md5.php');
require_once('./phpbb/passwords/driver/phpass.php');
require_once('./phpbb/passwords/driver/convert_password.php');
require_once('./phpbb/passwords/driver/sha1_smf.php');
require_once('./phpbb/passwords/driver/sha1.php');
require_once('./phpbb/passwords/driver/sha1_wcf1.php');
require_once('./phpbb/passwords/driver/md5_mybb.php');
require_once('./phpbb/passwords/driver/md5_vb.php');
require_once('./phpbb/passwords/driver/sha_xf1.php');
require_once('./phpbb/passwords/driver/argon2i.php');
require_once('./phpbb/passwords/driver/argon2id.php');

//set variables to be passed to manager metod in passwords/manager.php class...
$config = new \phpbb\config\config(array());
$passwords_helper = new \phpbb\passwords\helper($config);
$passwords_driver_helper = new \phpbb\passwords\driver\helper($config);
$passwords_drivers = array(
	'passwords.driver.bcrypt_2y'		=> new \phpbb\passwords\driver\bcrypt_2y($config, $passwords_driver_helper, 10),
	'passwords.driver.bcrypt'		=> new \phpbb\passwords\driver\bcrypt($config, $passwords_driver_helper, 10),
	'passwords.driver.salted_md5'		=> new \phpbb\passwords\driver\salted_md5($config, $passwords_driver_helper),
	'passwords.driver.phpass'		=> new \phpbb\passwords\driver\phpass($config, $passwords_driver_helper),
	'passwords.driver.convert_password'	=> new \phpbb\passwords\driver\convert_password($config, $passwords_driver_helper),
	'passwords.driver.sha1_smf'		=> new \phpbb\passwords\driver\sha1_smf($config, $passwords_driver_helper),
	'passwords.driver.sha1'			=> new \phpbb\passwords\driver\sha1($config, $passwords_driver_helper),
	'passwords.driver.sha1_wcf1'		=> new \phpbb\passwords\driver\sha1_wcf1($config, $passwords_driver_helper),
	'passwords.driver.md5_mybb'		=> new \phpbb\passwords\driver\md5_mybb($config, $passwords_driver_helper),
	'passwords.driver.md5_vb'		=> new \phpbb\passwords\driver\md5_vb($config, $passwords_driver_helper),
	'passwords.driver.sha_xf1'              => new \phpbb\passwords\driver\sha_xf1($config, $passwords_driver_helper),
    	'passwords.driver.argon2i'		=> new \phpbb\passwords\driver\argon2i($config, $passwords_driver_helper),
    	'passwords.driver.argon2id'		=> new \phpbb\passwords\driver\argon2id($config, $passwords_driver_helper),
);

//create instance of passwords\manager.php class...
$pw_manager = new \phpbb\passwords\manager($config, $passwords_drivers, $passwords_helper, array_keys($passwords_drivers));

//run check...
$is_correct_password = $pw_manager->check($password, $pw_hash);

//display if password is or is not good...
if($is_correct_password) {
    echo 'correct password';
} else {
    echo 'incorrect password';
}
