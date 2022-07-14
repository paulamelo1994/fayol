var XMLHttpRequestObject = false;


function crearAjax()
{
 
	try 
	{ 
		XMLHttpRequestObject = new ActiveXObject("Msxml2.XMLHTTP"); 
	} 
	catch (e) 
	{
		try
		{
			XMLHttpRequestObject= new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch (E) 
		{
			XMLHttpRequestObject = false;
		} 
	} 

	if (!XMLHttpRequestObject && typeof XMLHttpRequest!='undefined' )
		XMLHttpRequestObject = new XMLHttpRequest(); 

	return XMLHttpRequestObject;
}

function comprobarAjax()
{
	crearAjax();
	if(!resultado)
		error();

}

function error()
{
	var ppal = document.getElementById('div_principal');
	ppal.innerHTML='<cite>Su navegador no soporta Ajax</cite>';
}

function createSelect(ref_select, table, row, div, select_name, row1, row2, root_path)
{
	var combo = document.getElementById(ref_select);
	var key = combo.value;
	
	if(XMLHttpRequestObject) 
	{
		XMLHttpRequestObject.open("GET",root_path+"/php-scripts/xml_select.php?table="+table+"&row="+row+"&key="+key, true);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) 
			{
				var xmlDocument = XMLHttpRequestObject.responseXML;
				
				var num_childs = xmlDocument.firstChild.childNodes.length;
				var d = document.getElementById(div);
				var new_select = "<select name='"+select_name+"'>";
				new_select += "\n<option></option>";
				for(var i = 0; i < num_childs ; i++)
				{
					var rowI = xmlDocument.firstChild.getElementsByTagName("element")[i].getAttribute(row1);
					var rowII = xmlDocument.firstChild.getElementsByTagName("element")[i].getAttribute(row2);
					new_select += "\n<option value='"+rowI+"'>"+rowII+"</option>";
				}
				new_select += "\n</select>";
				d.innerHTML = new_select;
			}
		}
		XMLHttpRequestObject.send(null);
	}
}

function createInput(div, root_path)
{
	var d = document.getElementById(div);
	var new_input = "<br><br><img src=\""+root_path+"/Images/item_catalogo.jpg\" width=\"25\" height=\"25\" title=\"Item\" alt=\"\">&nbsp;<input type=\"radio\" name=\"tipo[]\" value=\"isbn\">ISBN&nbsp;&nbsp;<input type=\"radio\" name=\"tipo\" value=\"issn\">ISSN&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"item[]\" maxlength=\"15\" size=\"15\">&nbsp;&nbsp;<input type=\"submit\" name=\"agregar_item[]\" value=\"...\">";
	
	d.innerHTML += new_input;
}
