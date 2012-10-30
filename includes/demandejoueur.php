<script>
function loadresultat()
{
	if (document.getElementById('mobi').value=='d')
	{
		document.getElementById('cbox').style.display='none';
		document.getElementById('dbox').style.display='';
	}
	else if (document.getElementById('mobi').value=='c')
	{
		document.getElementById('cbox').style.display='';
		document.getElementById('dbox').style.display='none';
	}
	else
	{
		document.getElementById('cbox').style.display='none';
		document.getElementById('dbox').style.display='none';
	}
	dispo = document.getElementById('dispo').value;
	date = document.getElementById('date').value;
	mobi = document.getElementById('mobi').value;
	comite = document.getElementById('comite').value;
	sexe = document.getElementById('sexe').value;
	poste = document.getElementById('poste').value;
	niveau =document.getElementById('niveau').value;
	departement = document.getElementById('departement').value;

	Updatejs('resultat', 'ajax/moteur_offre_joueur.php?niveau='+niveau+'&poste='+poste+'&sexe='+sexe+'&dispo='+dispo+'&date='+date+'&mobi='+mobi+'&comite='+comite+'&departement='+departement);
}

</script>
<fieldset style="width: 600px;margin: 0px auto;" class="bgjaune">
	<legend>Recherche d'annonce</legend>
	<table style="float:left">
		<tr>
			<td><label>Par poste</label></td>
			<td>
				<?php
					liste_poste('', 'loadresultat()', 'Tous');
				?>
			</td>
		</tr>
		<tr>
			<td><label>Par niveau</label></td>
			<td>
				<?php liste_niveau('', 'loadresultat()', 'Tous') ?>
			</td>
		</tr>
		<tr>
			<td><label>Par disponibilité</label></td>
			<td><select id="dispo" onChange="loadresultat()">
				<option value="tous">Toutes</option>
				<option value="i">Immédiate</option>
				<option value="m">Moins de 3 mois</option>
				<option value="s">Saison prochaine</option>
			</select></td>
		</tr>
	</table>
	<table style="float:right">
		<tr>
			<td><label>Par genre</label></td>
			<td><select id="sexe" onChange="loadresultat()">
				<option value="tous">Tous</option>
				<option value="f">Féminin</option>
				<option value="m">Masculin</option>
			</select></td>
		</tr>
		<tr>
			<td><label>Par date</label></td>
			<td><select id="date" onChange="loadresultat()">
				<option value="tous">Peu importe</option>
				<option value="ASC">De la plus ancienne à la plus récente</option>
				<option value="DESC">De la plus récente à la plus ancienne</option>
			</select></td>
		</tr>
		<tr>
			<td><label>Par mobilité</label></td>
			<td><select id="mobi" onChange="loadresultat()">
				<option value="tous">Toutes</option>
				<option value="n">Nationnale</option>
				<option value="d">Départementale</option>
				<option value="c">Comité</option>
			</select></td>
		</tr>
		<tr id="cbox" style="display: none;">
			<td><label>Comité spécifique</label></td>
			<td><?php liste_comite('', 'loadresultat()'); ?></td>
		</tr>
		<tr id="dbox" style="display: none;">
			<td><label>Département spécifique</label></td>
			<td><?php liste_departements('', 'loadresultat()'); ?></td>
		</tr>
	</table>
</fieldset>
<br />
<div id="resultat">
<script>loadresultat()</script>
</div>
