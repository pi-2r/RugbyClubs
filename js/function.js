function ToogleBox(div)
{
	etat = document.getElementById(div).style.display
	if (etat == 'none')
		Effect.BlindDown(div);
	else
		Effect.BlindUp(div);
}
function ToogleVisiBox(div)
{
	etat = document.getElementById(div).style.visibility;
	if (etat == 'hidden')
		document.getElementById(div).style.visibility = 'visible';
	else
		document.getElementById(div).style.visibility = 'hidden';
}
function writediv(div,texte,info,type)
     {
     document.getElementById(div).innerHTML = texte;
	 }

function Updatejs(content, data)
{
	new Ajax.Updater(content, data, { onSuccess: function(){new Effect.Appear(content); windows.eval();}});
}

function createDivFb()
{
var newdiv = document.createElement('div');
var divIdName = 'infobox';
newdiv.setAttribute('id',divIdName);
newdiv.style.display = "none";
newdiv.style.width = "621px";
newdiv.style.height = "499px";
newdiv.style.left = "400px";
newdiv.style.top = "100px";
newdiv.style.position = "absolute";
newdiv.style.background = "url('images/bgbox.png') no-repeat";
newdiv.innerHTML = '<div style="width:591px;height:450px;margin-top:15px;margin-left:15px"><iframe name="framefb" src="connect.php"></div><div style="width:100px;height:20px;margin-left:520px;margin-top:4px;cursor:pointer" onclick="closebox()"></div>';
document.body.appendChild(newdiv);
new Draggable('infobox');
new Effect.Appear('infobox');
}

function closebox()
{
new Effect.Fade('infobox', {afterFinish: function(){ Element.remove('infobox'); }});
}

function file(fichier)
     {
     if(window.XMLHttpRequest) // FIREFOX
          xhr_object = new XMLHttpRequest();
     else if(window.ActiveXObject) // IE
          xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
     else
          return(false);
     xhr_object.open("GET", fichier, false);
     xhr_object.send(null);
     if(xhr_object.readyState == 4) return(xhr_object.responseText);
     else return(false);
     }
