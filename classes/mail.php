<?php
class sendmail
{
	public function send($dest, $content)
	{
		$headers = 'Mime-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
		$headers .= "\r\n";

		$msg = $content.'<br /><br />Cordialement, l\'équipe KaapStad.fr';

		mail($dest, 'L\'équipe KaapStad.fr', $msg);
	}
}
$ksmail = new sendmail;
