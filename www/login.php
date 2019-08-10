<?php
include('../inc/bootstrap.php');
include('../inc/form.php');

if (isset($_POST['_form'], $_POST['usr'], $_POST['pwd'])) {
	if (!isset($_POST['yummie'])) {
		$loginerr = 'You can\'t login without accepting cookies.';
		goto skiplogin;
	}
	$stmt = $db->prepare('SELECT i,p FROM usr WHERE n=? LIMIT 1');
	$stmt->bindValue(1, $_POST['usr']);
	if ($stmt->execute() && ($r = $stmt->fetchAll()) && count($r)) {
		$r = $r[0];
		$id = $r->i;
		if (password_verify($_POST['pwd'], $r->p)) {
			$stay = isset($_POST['stay']);
			$sesid = generate_random_key();
			$stmt = $db->prepare('INSERT INTO webses(id,user,start,lastupdate,stay,ip) VALUES(?,?,UNIX_TIMESTAMP(),UNIX_TIMESTAMP(),?,?)');
			$stmt->bindValue(1, $sesid);
			$stmt->bindValue(2, $id);
			$stmt->bindValue(3, $stay ? 1 : 0);
			$stmt->bindValue(4, $__clientip);
			$stmt->execute();
			$expire = $stay ? (time() + 30 * 24 * 3600) : 0;
			setcookie($SESSIONCOOKIENAME1, $sesid, $expire, $COOKIEPATH, $COOKIEDOMAIN, $COOKIEHTTPS, true);
			$loginerr = 'yes';
		} else {
			$stmt = $db->prepare('INSERT INTO fal(u,t,j,isweb) VALUES(?,UNIX_TIMESTAMP(),?,1)');
			$stmt->bindValue(1, $id);
			$stmt->bindValue(2, $__clientip);
			$stmt->execute();
			$loginerr = 'Password incorrect';
		}
		unset($_POST['pwd']);
	} else {
		$loginerr = 'User not found';
	}
} skiplogin:

$__script = '_login';
include('../inc/output.php');