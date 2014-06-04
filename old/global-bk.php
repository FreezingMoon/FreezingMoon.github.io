<?php
// Bloody web host escapes all our input data and assumes we're idiots, need to reverse this
function UnescapeData() {
	if (get_magic_quotes_gpc()) {
		$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
		while (list($key, $val) = each($process)) {
			foreach ($val as $k => $v) {
				unset($process[$key][$k]);
				if (is_array($v)) {
					$process[$key][stripslashes($k)] = $v;
					$process[] = &$process[$key][stripslashes($k)];
				} else {
					$process[$key][stripslashes($k)] = stripslashes($v);
				}
			}
		}
		unset($process);
	}
}
UnescapeData();

/* Database functions */
function ConnectDatabase() {
	if (!mysql_connect('mysql1105.ixwebhosting.com', 'C332527_dread', 'startAwar87'))
		return false;
	if (!mysql_select_db("C332527_fm"))
		return false;
	mysql_query("SET NAMES 'utf8'");
	return true;
}
function CleanupDatabase() {
	mysql_query("CALL fm_cleanup(@pending, @sessions, @resets, @changes)");
	return mysql_fetch_row(mysql_query("SELECT @pending, @sessions, @resets, @changes"));
}
if(!ConnectDatabase()) {
	// TODO: Redirect to an error page here...
	echo "Database connection failed";
	exit();
}

/* Misc functions */
function StopPage() {
	header("Location: /");
	exit();
}
function URLPageTitle($s) {
	return strtolower(preg_replace("#[^A-Za-z0-9_]+#", "-", $s));
}

/* Hashing functions */
$ServerHashingKey = ")Fx32LpIK|GAqCK!>wz~gN`#RCW4}0FDP&}jzG!`^kt$(nbL%z/`8NqT+(T-HCq^UBUxm9J:k\"=<kg&G$\"Iv*.Ml7xRPC\"0MEWqN{\"z)FiAkC~$+}<m+v8|mg-fVA=N&";
function RandomString($len) {
	$bytes = "";
	for($i = 0; $i < $len; $i++) {
		$bytes .= chr(mt_rand(33, 126));
	}
	return $bytes;
}
function RandomPassword($len) {
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$charLen = strlen($characters) - 1;
	for($i = 0; $i < $len; $i++) {
		$bytes .= $characters[mt_rand(0, $charLen)];
	}
	return $bytes;
}
function WhirlpoolWithNewSalt($input, $saltLen) {
	if($saltLen % 2 != 0)
		return null;
	$salt = RandomString($saltLen);
	$hash = hash_hmac("whirlpool", substr($salt, 0, $saltLen / 2) . $input . substr($salt, $saltLen / 2), $ServerHashingKey);
	return array($hash, $salt);
}
function WhirlpoolWithSalt($input, $salt) {
	$len = strlen($salt);
	if($len % 2 != 0)
		return null;
	return hash_hmac("whirlpool", substr($salt, 0, $len / 2) . $input . substr($salt, $len / 2), $ServerHashingKey);
}

function UserInfo() {
	if(!(isset($_COOKIE["token"]) && strlen($_COOKIE["token"]) == 64))
		return null;
	$token = $_COOKIE["token"];
	$id = mysql_result(mysql_query("SELECT `userID` FROM `fm_users_sessions` WHERE `token`='" . mysql_real_escape_string($token) . "' AND `ip`='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' AND `expiry` > NOW()"), 0, 0);
	if($id == false) {
		setcookie('token', '', 0, '/', '.freezingmoon.org');
		return null;
	}
	mysql_query("UPDATE `fm_users_sessions` SET `expiry`=DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE `token`='" . mysql_real_escape_string($token) . "' AND `ip`='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "'");
	setcookie('token', $token, time() + 86400, '/', '.freezingmoon.org');
	$result = mysql_fetch_row(mysql_query("SELECT `username`, `email` FROM `fm_users` WHERE `ID` = $id"));
	$permissions = mysql_result(mysql_query("SELECT `Permissions` FROM `fm_users_permissions` WHERE `UserID` = $id"), 0, 0);
	if($permissions == false)
		$permissions = Permissions::Registered;
	return new UserInformation((int)$id, $result[0], $result[1], (int)$permissions);
}
$CurrentUser = UserInfo();
function LoginUser($id) {
	global $CurrentUser;
	if(!is_numeric($id))
		return;
	if($CurrentUser !== null)
		return;
	$id = (int)$id;
	$token = RandomString(64);
	mysql_query("INSERT INTO `fm_users_sessions` VALUES($id, '" . mysql_real_escape_string($token) . "', DATE_ADD(NOW(), INTERVAL 1 DAY), '" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "')");
	setcookie('token', $token, time() + 86400, '/', '.freezingmoon.org');
}
function LogoutUser() {
	global $CurrentUser;
	if($CurrentUser === null)
		return;
	mysql_query("DELETE FROM `fm_users_sessions` WHERE `token`='" . mysql_real_escape_string($_COOKIE["token"]) . "' AND `ip`='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "'");
	setcookie('token', '', 0, '/', '.freezingmoon.org');
}
?>
