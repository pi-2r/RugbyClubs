<?php

function getcouleur($couleur)
{
	switch ($couleur)
	{
		case noir:
			return black;
			break;
		case blanc:
			return white;
			break;
		case rouge:
			return red;
			break;
		case bleu:
			return blue;
			break;
		case jaune:
			return yellow;
			break;
		case rose:
			return pink;
			break;
		case sang:
			return firebrick3;
			break;
		case 'or':
			return gold;
			break;
		case marine:
			return navy;
			break;
		case vert:
			return green;
			break;
		case gris:
			return gray;
			break;
		case orange:
			return orange;
			break;
	}
}

function majuscule($chaine)
{

$pos = $chaine[0];
$maj = strtoupper($pos);
$i = 1;
$Suite = "";
while ($chaine[$i])
{
$Suite .= $chaine[$i];
$i++;
}
$ChaineConvert = $maj.$Suite;
return $ChaineConvert;
}

function liste_comite($select='', $onchange='')
{
	$res = mysql_query("SELECT * FROM `comites` ORDER BY `nom`");
	?>
	<select onChange="<?php echo $onchange; ?>" class="required validate-selection" id="comite" name="comite">
		<option>Choisissez</option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id'])
					echo '<option selected=selected value="'.$data['id'].'">'.$data['nom'].'</option>';
				else
					echo '<option value="'.$data['id'].'">'.$data['nom'].'</option>';
		?>
	</select>
	<?php
}

function liste_specialite($select='', $onchange='', $premier='Choisissez')
{
	$res = mysql_query("SELECT * FROM `specialites`");
	?>
	<select onChange="<?php echo $onchange; ?>"class="required validate-selection" id="specialite" name="specialite">
		<option><?php echo $premier; ?></option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id_spe'] && !empty($select))
					echo '<option selected=selected value="'.$data['id_spe'].'">'.$data['lib_spe'].'</option>';
				else
					echo '<option value="'.$data['id_spe'].'">'.$data['lib_spe'].'</option>';
		?>
	</select>
	<?php
}

function liste_niveau($select='', $onchange='', $premier='Choisissez')
{
	$res = mysql_query("SELECT * FROM `niveau`");
	?>
	<select onChange="<?php echo $onchange; ?>"class="required validate-selection" id="niveau" name="niveau">
		<option><?php echo $premier; ?></option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id_niv'] && !empty($select))
					echo '<option selected=selected value="'.$data['id_niv'].'">'.$data['lib_niv'].'</option>';
				else
					echo '<option value="'.$data['id_niv'].'">'.$data['lib_niv'].'</option>';
		?>
	</select>
	<?php
}

function liste_poste($select='', $onchange='', $premier='Choisissez')
{
	$res = mysql_query("SELECT * FROM `poste` ORDER BY `id`");
	?>
	<select onChange="<?php echo $onchange; ?>" class="required validate-selection" id="poste" name="poste">
		<option><?php echo $premier; ?></option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id'])
					echo '<option selected=selected value="'.$data['id'].'">'.$data['poste'].'</option>';
				else
					echo '<option value="'.$data['id'].'">'.$data['poste'].'</option>';
		?>
	</select>
	<?php
}

function liste_nationalite($select='')
{
	$res = mysql_query("SELECT * FROM `pays`");
	?>
	<select class="required validate-selection" id="nation" name="nation">
		<option>Choisissez</option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id'])
					echo '<option selected=selected value="'.$data['id'].'">'.$data['nation'].'</option>';
				else
					echo '<option value="'.$data['id'].'">'.$data['nation'].'</option>';
		?>
	</select>
	<?php
}
function liste_departements($select='', $onchange='')
{
	$res = mysql_query("SELECT * FROM `departements` ORDER BY nom_dep");
	?>
	<select onChange="<?php echo $onchange; ?>" class="required validate-selection" id="departement" name="departement">
		<option>Choisissez</option>
		<?php
			while ($data = mysql_fetch_array($res))
				if ($select == $data['id_dep'])
					echo '<option selected=selected value="'.$data['id_dep'].'">'.$data['nom_dep'].'</option>';
				else
					echo '<option value="'.$data['id_dep'].'">'.$data['nom_dep'].'</option>';
		?>
	</select>
	<?php
}


function age($naiss)  {
  list($annee, $mois, $jour) = split('[-.]', $naiss);
  $today['mois'] = date('n');
  $today['jour'] = date('j');
  $today['annee'] = date('Y');
  $annees = $today['annee'] - $annee;
  if ($today['mois'] <= $mois) {
    if ($mois == $today['mois']) {
      if ($jour > $today['jour'])
        $annees--;
      }
    else
      $annees--;
    }
  return $annees;
}
function tofr($date)
{
	$date = explode('-', $date);
	switch ($date[1])
	{
		case 01:
			$mois = 'Janvier';
			break;
		case 02:
			$mois = 'Février';
			break;
		case 03:
			$mois = 'Mars';
			break;
		case 04:
			$mois = 'Avril';
			break;
		case 05:
			$mois = 'Mai';
			break;
		case 06:
			$mois = 'Juin';
			break;
		case 07:
			$mois = 'Juillet';
			break;
		case 08:
			$mois = 'Aout';
			break;
		case 09:
			$mois = 'Septembre';
			break;
		case 10:
			$mois = 'Octobre';
			break;
		case 11:
			$mois = 'Novembre';
			break;
		case 12:
			$mois = 'Décembre';
			break;
	}
	return $date[2].' '.$mois.' '.$date[0];
}
