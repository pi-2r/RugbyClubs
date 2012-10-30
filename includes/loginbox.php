	<?php
						if($_SESSION['auth'] == TRUE)
						{
							echo 'Bienvenue <strong>'.$pseudo.' </strong> - <a href="index.php?p=panel">Votre panel</a> - <a href="index.php?p=deconnexion">Se deconnecter</a>';
						}
						else
						{ ?>
							<form method="post" action="connexion.php">
								<label for="login">Email</label> :  <input type="text" name="login" id="login"/> &nbsp;
								<label for="pass">Mot de passe</label> :  <input type="password" name="password" id="password"/> &nbsp;
								<input type="submit" value=" " class="submit" />&nbsp;&nbsp;&nbsp;&nbsp;
										<strong><a href="index.php?p=inscription" style="color:#fff">Inscription</a></strong>
							</form>
						<?php } ?>
