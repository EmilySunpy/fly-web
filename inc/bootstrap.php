<?php
$__timer = microtime(true);

$__msgs = [];

require('../inc/conf.php');
include('../inc/db.php');

if (!isset($p_accent_color_a)) {
	$p_accent_color_a = 'ddd';
	$p_accent_color_b = 'bbb';
}

function simple_pagination($urlWithParam, $currentPageFromOne, $totalPages)
{
	$str = '<p class="pagination">Page:';
	for ($i = 0; $i < $totalPages; ) {
		$i++;
		if ($i == $currentPageFromOne) {
			$str .= ' <b>' . $i . '</b>';
		} else {
			$str .= " <a href=\"{$urlWithParam}{$i}\">{$i}</a>";
		}
	}
	$str .= '</p>';
	return $str;
}

function format_duration_short($time)
{
	if ($time < 2) {
		return '1 second';
	}
	if ($time < 60) {
		return $time . ' seconds';
	}
	if ($time < 120) {
		return '1 minute';
	}
	if ($time < 3600) {
		return round($time / 60, 0) . ' minutes';
	}
	if ($time < 7200) {
		return '1 hour';
	}
	return round($time / 3600, 0) . ' hours';
}

function format_time_since($time)
{
	$tdiff = time() - $time;
	if ($tdiff < 86400) {
		return 'today';
	}
	if ($tdiff < 172800) {
		return 'yesterday';
	}
	if ($tdiff < 5184000) {
		return floor($tdiff / 86400) . ' days ago';
	}
	$tyear = (int) date('Y', $time);
	$nowyear = (int) date('Y');
	$tmonth = (int) date('n', $time);
	$nowmonth = (int) date('n');
	$dyear = $nowyear - $tyear;
	$dmonth = $nowmonth - $tmonth;
	if ($dmonth < 0) {
		$dmonth += 12;
		$dyear--;
	}
	$str = '';
	$glue = ', ';
	if ($dyear < 1) {
		$glue = '';
	} else if ($dyear < 2) {
		$str = '1 year';
	} else {
		$str = $dyear . ' years';
	}
	if ($dmonth < 1) {
	} else if ($dmonth < 2) {
		$str .= $glue . '1 month';
	} else {
		$str .= $glue . $dmonth . ' months';
	}
	return $str . ' ago';
}

if (isset($__script)) {
	include('../inc/output.php');
}