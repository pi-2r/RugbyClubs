<?php
	$date = date("Y-m-d");
	$req = $sql->lire('publicite', "E_id_comites=$infoclub[E_id_comites] AND (compteur !=0 AND datefin > $date) ORDER BY compteur DESC", FALSE);
	if (mysql_num_rows($req) == 0)
	{
			// Pas de comité particulier, on regarde si il y a un niveau
			$req = $sql->lire('publicite', "E_id_comites=0 AND E_id_niveau=$infoclub[E_id_niveau] AND (compteur !=0 AND datefin > $date) ORDER BY compteur DESC", FALSE);
			if (mysql_num_rows($req) == 0)
			{
				// Pas de comité particulier, pas de niveau particulier, un club ?
				$req = $sql->lire('publicite', "E_id_comites=0 AND E_id_niveau=0 AND E_id_club=$infoclub[E_id_club] AND (compteur !=0 AND datefin > $date) ORDER BY compteur DESC", FALSE);
				if (mysql_num_rows($req) == 0)
				{
					$req = $sql->lire('publicite', "compteur !=0 AND datefin > $date ORDER BY compteur DESC",FALSE);
					if (mysql_num_rows($req) != 0)
					{
						$req = @mysql_fetch_array($req);
						echo ('<br /><img src="'.$req[logo].'" width="200px" alt="'.$req[nom].'" /><br />'.$data[designation]);
						$sql->requete("UPDATE publicite SET compteur=compteur-1 WHERE id=$req[id]", FALSE);
					}
					else
					{
						echo ('<br /><br /><br/>Votre publicité ici ?<br /><a href="mailto:contact@kaapstad.fr" title="Contacter nous!">Contacter nous</a>');
					}
				}
				else
				{
					//Une pub ou plusieurs est définit pour ce club là. On affiche le compteur le moins grand
					$data = @mysql_fetch_array($req);
					echo ('<br /><img src="'.$data[logo].'" width="200px" alt="'.$data[nom].'" /><br />'.$data[designation]);
					$sql->requete("UPDATE publicite SET compteur=compteur-1 WHERE id=$data[id]", FALSE);
				}
			}
			else
			{
				//Pub trouvée, on affiche
				$data = @mysql_fetch_array($req);
				echo ('<br /><img src="'.$data[logo].'" width="200px" alt="'.$data[nom].'" /><br />'.$data[designation]);
				$sql->requete("UPDATE publicite SET compteur=compteur-1 WHERE id=$data[id]", FALSE);
			}
	}
	else
	{
		// Pub trouvée, on affiche
		$data = @mysql_fetch_array($req);
		echo ('<br /><img src="'.$data[logo].'" width="200px" alt="'.$data[nom].'" /><br />'.$data[designation]);
		$sql->requete("UPDATE publicite SET compteur=compteur-1 WHERE id=$data[id]", FALSE);
	}
