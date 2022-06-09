<script language="javascript" type="text/javascript">
	function updateTotal()
	{
		if(document.formt.valorconiva1.value!="")
		{
			a=eval(document.formt.valorconiva1.value);
		}
		else
		{
			a=0;
		}
		if(document.formt.valorconiva2.value!="")
		{
			b=eval(document.formt.valorconiva2.value);
		}
		else
		{
			b=0;
		}
		if(document.formt.valorconiva3.value!="")
		{
			c=eval(document.formt.valorconiva3.value);
		}
		else
		{
			c=0;
		}
		if(document.formt.valorconiva4.value!="")
		{
			d=eval(document.formt.valorconiva4.value);
		}
		else
		{
			d=0;
		}
		if(document.formt.valorconiva5.value!="")
		{
			e=eval(document.formt.valorconiva5.value);
		}
		else
		{
			e=0;
		}
		document.formt.totalconiva.value = a+b+c+d+e;
		
		
		if(document.formt.valorsiniva1.value!="")
		{
			a=eval(document.formt.valorsiniva1.value);
		}
		else
		{
			a=0;
		}
		if(document.formt.valorsiniva2.value!="")
		{
			b=eval(document.formt.valorsiniva2.value);
		}
		else
		{
			b=0;
		}
		if(document.formt.valorsiniva3.value!="")
		{
			c=eval(document.formt.valorsiniva3.value);
		}
		else
		{
			c=0;
		}
		if(document.formt.valorsiniva4.value!="")
		{
			d=eval(document.formt.valorsiniva4.value);
		}
		else
		{
			d=0;
		}
		if(document.formt.valorsiniva5.value!="")
		{
			e=eval(document.formt.valorsiniva5.value);
		}
		else
		{
			e=0;
		}
		document.formt.totalsiniva.value = a+b+c+d+e;
	}
	
	function validate()
	{
		valid=true;
		if(document.formt.proveedor.value=="")
		{
			alert("Debe proporcionar el nombre del proveedor");
			valid=false;
		}
		else
		{
			if(document.formt.nit.value=="")
			{
				alert("Debe proporcionar su número de NIT");
				valid=false;
			}
			else
			{
				if(document.formt.direccion.value=="")
				{
					alert("Debe indicar su dirección");
					valid=false;
				}
				else
				{
					if(document.formt.numeroTelefonico.value=="")
					{
						alert("Debe indicar su número telefónico");
						valid=false;
					}
					else
					{
						if(document.formt.ciudad.value=="")
						{
							alert("Debe indicar su ciudad");
							valid=false;
						}
						else
						{
							if(document.formt.dependencia.value=="")
							{
								alert("Debe indicar la dependencia a la que pertenece");
								valid=false;
							}
							else
							{
								if(document.formt.division.value=="")
								{
									alert("Debe indicar la división a la que está adscrito(a)");
									valid=false;
								}
							}
						}
					}
				}
			}
		}
		return valid;
	}
</script>

<FORM onSubmit="return validate()" name="formt" method="post" ACTION="index.php?item=2">
<TABLE WIDTH="100%"  BORDER="0" ALIGN="CENTER" CELLPADDING="5">
	<TR>
		<TD><H2 ALIGN="CENTER">Informaci&oacute;n del solicitante </H2>
		  <TABLE width=100% border=1>
            	<TBODY>
            		<TR bgColor=#cccccc vAlign=top>
            			<TD width="61%"><P><FONT size=-1><b>Orden de pedido</b></FONT></P></TD>
       			  </TR>
            		<TR vAlign=top>
            			<TD><TABLE width="100%" border=0 align=center>
            					<TBODY>
            						<TR>
            							<TD width="29%"><FONT size=-1>Tipo de solicitud</FONT></TD>
            							<TD width="71%"><FONT size=-1>
            							  <INPUT name="tipo" type=radio 
            value='compra' CHECKED>
Compra</FONT><FONT size=-1>
<INPUT name="tipo" type=radio 
            value='obras'>
Obras
<INPUT name="tipo" type=radio 
            value='servicios'>
Servicios 
<INPUT name="tipo" type=radio 
            value='otro'>
Otro </FONT></TD>
       							  </TR>
            						<TR>
            							<TD><FONT size=-1><p id="Iproveedor" style="color:#000000">Proveedor</p></FONT></TD>
            							<TD><INPUT name=proveedor 
            size=45 MAXLENGTH="100" value="<?= $_POST['proveedor'] ?>">
       								  </TD>
       							  </TR>
            						<TR>
                                      <TD><FONT size=-1>Nit</FONT></TD>
                                      <TD><INPUT name=nit size=45 MAXLENGTH="100" value="<?= $_POST['nit'] ?>">
                                      </TD>
          						  </TR>
            						<TR>
            						  <TD><FONT size=-1>Direcci&oacute;n</FONT></TD>
            						  <TD><INPUT name=direccion size=45 MAXLENGTH="100" value="<?= $_POST['direccion'] ?>"></TD>
          						  </TR>
            						<TR>
            						  <TD><font size="-1">N&uacute;mero telef&oacute;nico </font></TD>
            						  <TD><INPUT name=numeroTelefonico size=45 MAXLENGTH="100" value="<?= $_POST['numeroTelefonico'] ?>"></TD>
          						  </TR>
            						<TR>
            						  <TD><FONT size=-1>Ciudad</FONT></TD>
            						  <TD><INPUT name=ciudad size=45 MAXLENGTH="100" value="<?= $_POST['ciudad'] ?>"></TD>
          						  </TR>
            						<TR>
            						  <TD><font size="-1">Facultad/Dependencia solicitante</font></TD>
            						  <TD><INPUT name=dependencia size=45 MAXLENGTH="100" value="<?= $_POST['dependencia'] ?>"></TD>
           						  </TR>
            						<TR>
            						  <TD><font size="-1">Divisi&oacute;n/Secci&oacute;n/Departamento/Oficina</font></TD>
            						  <TD><INPUT name=division size=45 MAXLENGTH="100" value="<?= $_POST['division'] ?>"></TD>
           						  </TR>
   						  </TBODY>
            					</TABLE></TD>
           			</TR>
       		  </TBODY>
		  </TABLE>
			<p>&nbsp;</p>
						<H2 ALIGN="CENTER">Descripci&oacute;n de la solicitud </H2>
			            <TABLE width=100% border=1>
            	<TBODY>
				 <TR bgColor=#cccccc>
            			<TD><FONT size=-1><b>Informaci&oacute;n de la solicitud </b></FONT></TD>
				 </TR>
            		<TR>
            			<TD height="285"><TABLE align=center border=0 width="100%">
            					<TBODY>
            						<TR>
            							<TD><FONT size=-1> Descripci&oacute;n</FONT></TD>
            							<TD WIDTH="50%"><textarea name="descripcion"  cols=33></textarea></TD>
       							  </TR>
            						<TR>
            							<TD><FONT size=-1> Dep</FONT></TD>
            							<TD><INPUT NAME=dep ID="dep" SIZE=30 MAXLENGTH="100" value="<?= $_POST['dep'] ?>"></TD>
       							  </TR>
            						<TR>
            							<TD><FONT size=-1> CTA</FONT></TD>
            							<TD><input name=cta id="cta" size=30 maxlength="100" value="<?= $_POST['cta'] ?>"></TD>
       							  </TR>
            						<TR>
            							<TD><FONT size=-1>ACT/P</FONT></TD>
            							<TD><INPUT name=act ID="act" size=30 MAXLENGTH="100" value="<?= $_POST['act'] ?>">
       								  </TD>
       							  </TR>
            						<TR>
            							<TD width="50%"><FONT size=-1> Subgrupo</FONT></TD>
            							<TD><FONT size=-1>
            								<INPUT name=subgrupo ID="subgrupo" size=30 MAXLENGTH="100" value="<?= $_POST['subgrupo'] ?>">
            							</FONT></TD>
       							  </TR>
            						<TR>
                                      <TD><FONT size=-1>CC</FONT></TD>
                                      <TD><INPUT name=cc ID="cc" size=30 MAXLENGTH="100" value="<?= $_POST['cc'] ?>">
                                      </TD>
          						  </TR>
            						<TR>
                                      <TD><FONT size=-1> CI</FONT></TD>
                                      <TD><FONT size=-1>
                                        <INPUT name=ci ID="ci" size=30 MAXLENGTH="100" value="<?= $_POST['ci'] ?>">
                                      </FONT></TD>
          						  </TR>
            						<TR>
                                      <TD><FONT size=-1> Registro presupuestal </FONT></TD>
                                      <TD><FONT size=-1>
                                        <INPUT name=registropresupuestal ID="registropresupuestal" size=30 MAXLENGTH="100" value="<?= $_POST['registropresupuestal'] ?>">
                                      </FONT></TD>
          						  </TR>
   						  </TBODY>
   					  </TABLE></TD>
       			  </TR>
       		  </TBODY>
       	  </TABLE>
			<BR>
			<H2 ALIGN="CENTER">Detalle de los productos </H2>
			<TABLE border=1 width=100%>
            	<TBODY>
				 <TR bgColor=#cccccc>
            			<TD><P><FONT size=-1><B>Detalle de la solicitud </B></FONT></P></TD>
   			    </TR>
            		<TR>
            			<TD height="248"><TABLE align=center border=0 width="100%">
            					<TBODY>
            						<TR>
            						  <TD width="39" align=center><? if($prod['error']['cantidad']){?>(<font size=-1 color="#FF0000">*</font>)<?}?><FONT size=-1>Cant</FONT></TD>
            						  <TD width="39" align=center><? if($prod['error']['unidades']){?>(<font size=-1 color="#FF0000">*</font>)<?}?><font size="-1">Unid</font></TD>
            						  <TD colspan="2" align=center><? if($prod['error']['descripcionespecifica']){?>(<font size=-1 color="#FF0000">*</font>)<?}?><FONT size=-1>Descripci&oacute;n espec&iacute;fica </FONT></TD>
            						  <TD width="78" align=center><? if($prod['error']['valorsiniva']){?>(<font size=-1 color="#FF0000">*</font>)<?}?><font size="-1">Valor unitario sin IVA </font></TD>
            						  <TD width="79" align=center><? if($prod['error']['valorconiva']){?>(<font size=-1 color="#FF0000">*</font>)<?}?><FONT size=-1>Valor total sin IVA </FONT></TD>
            						</TR>
            						<TR>
            						  <TD align=center><FONT size=-1>
            						    <INPUT name=cantidad1 ID="cantidad1" size=5 MAXLENGTH="100" value="<?= $_POST['cantidad1'] ?>">
            						  </FONT></TD>
            						  <TD align=center><FONT size=-1>
            						    <INPUT name=unidades1 ID="unidades1" size=5 MAXLENGTH="100" value="<?= $_POST['unidades1'] ?>">
            						  </FONT></TD>
            						  <TD colspan="2" align=center><FONT size=-1>
            						    <INPUT name=descripcionespecifica1 ID="descripcionespecifica1" size=70 MAXLENGTH="100" value="<?= $_POST['descripcionespecifica1'] ?>">
            						  </FONT></TD>
            						  <TD align=center><FONT size=-1>
            						    <INPUT onBlur="updateTotal()" name=valorsiniva1 ID="valorsiniva1" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva1'] ?>">
            						  </FONT></TD>
            						  <TD align=center><FONT size=-1>
            						    <INPUT onBlur="updateTotal()"   name=valorconiva1 ID="valorconiva1" size=5 MAXLENGTH="100" value="<?= $_POST['valorconiva1'] ?>">
            						  </FONT></TD>
            						</TR>
            						<TR>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=cantidad2 ID="cantidad2" size=5 MAXLENGTH="100" value="<?= $_POST['cantidad2'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=unidades2 ID="unidades2" size=5 MAXLENGTH="100" value="<?= $_POST['unidades2'] ?>">
                                      </FONT></TD>
                                      <TD colspan="2" align=center><FONT size=-1>
                                        <INPUT name=descripcionespecifica2 ID="descripcionespecifica2" size=70 MAXLENGTH="100" value="<?= $_POST['descripcionespecifica2'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorsiniva2 ID="valorsiniva2" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva2'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorconiva2 ID="valorconiva2" size=5 MAXLENGTH="100" value="<?= $_POST['valorconiva2'] ?>">
                                      </FONT></TD>
          						  </TR>
            						<TR>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=cantidad3 ID="cantidad3" size=5 MAXLENGTH="100" value="<?= $_POST['cantidad3'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=unidades3 ID="unidades3" size=5 MAXLENGTH="100" value="<?= $_POST['unidades3'] ?>">
                                      </FONT></TD>
                                      <TD colspan="2" align=center><FONT size=-1>
                                        <INPUT name=descripcionespecifica3 ID="descripcionespecifica3" size=70 MAXLENGTH="100" value="<?= $_POST['descripcionespecifica3'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorsiniva3 ID="valorsiniva3" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorconiva3 ID="valorconiva3" size=5 MAXLENGTH="100" value="<?= $_POST['valorconiva3'] ?>">
                                      </FONT></TD>
          						  </TR>
            						<TR>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=cantidad4 ID="cantidad4" size=5 MAXLENGTH="100" value="<?= $_POST['cantidad4'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=unidades4 ID="unidades4" size=5 MAXLENGTH="100" value="<?= $_POST['unidades4'] ?>">
                                      </FONT></TD>
                                      <TD colspan="2" align=center><FONT size=-1>
                                        <INPUT name=descripcionespecifica4 ID="descripcionespecifica4" size=70 MAXLENGTH="100" value="<?= $_POST['descripcionespecifica4'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorsiniva4 ID="valorsiniva4" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva4'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorconiva4 ID="valorconiva4" size=5 MAXLENGTH="100" value="<?= $_POST['valorconiva4'] ?>">
                                      </FONT></TD>
          						  </TR>
            						<TR>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=cantidad5 ID="cantidad5" size=5 MAXLENGTH="100" value="<?= $_POST['cantidad5'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT name=unidades5 ID="unidades5" size=5 MAXLENGTH="100" value="<?= $_POST['unidades5'] ?>">
                                      </FONT></TD>
                                      <TD colspan="2" align=center><FONT size=-1>
                                        <INPUT name=descripcionespecifica5 ID="descripcionespecifica5" size=70 MAXLENGTH="100" value="<?= $_POST['descripcionespecifica5'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorsiniva5 ID="valorsiniva5" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva5'] ?>">
                                      </FONT></TD>
                                      <TD align=center><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valorconiva5 ID="valorconiva5" size=5 MAXLENGTH="100" value="<?= $_POST['valorconiva5'] ?>">
                                      </FONT></TD>
          						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD colspan="2" align=right><font size="-1">Total</font></TD>
            						  <TD align=center><FONT size=-1>
                                        <INPUT disabled name=totalsiniva ID="totalsiniva" size=5 MAXLENGTH="100" value="<?= $_POST['totalsiniva'] ?>">
                                      </FONT></TD>
            						  <TD align=center><FONT size=-1>
                                        <INPUT disabled name=totalconiva ID="totalconiva" size=5 MAXLENGTH="100" value="<?= $_POST['totalconiva'] ?>">
                                      </FONT></TD>
           						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD width="564" align=right>&nbsp;</TD>
            						  <td width="43" align="center" valign="middle">&nbsp;</td>
            						  <td width="78"><font size="-1"><strong>Subtotal sin I.V.A. </strong></font></td>
            						  <td width="79" align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=subtotalsiniva ID="subtotalsiniva" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
           						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=right>&nbsp;</TD>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=porcentajedescuento ID="porcentajedescuento" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
            						  <td><font size="-1"><strong>Descuento</strong></font></td>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=descuento ID="descuento" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
           						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=right>&nbsp;</TD>
            						  <td align="center" valign="middle"><FONT size=-1>&nbsp;                                      </FONT></td>
            						  <td><font size="-1"><strong>Subtotal con Dcto </strong></font></td>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=subtotalcondescuento ID="subtotalcondescuento" size=5 MAXLENGTH="100" value="<?= $_POST['subtotalcondescuento'] ?>">
                                      </FONT></td>
           						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=right>&nbsp;</TD>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=porcentajeiva ID="porcentajeiva" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
            						  <td><font size="-1"><strong>I.V.A.</strong></font></td>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=iva ID="iva" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
           						  </TR>
            						<TR>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=center>&nbsp;</TD>
            						  <TD align=right>&nbsp;</TD>
            						  <td align="center" valign="middle"><FONT size=-1>&nbsp;                                      </FONT></td>
            						  <td><font size="-1"><strong>Total con I.V.A. </strong></font></td>
            						  <td align="center" valign="middle"><FONT size=-1>
                                        <INPUT onBlur="updateTotal()" name=valortotalconiva ID="valortotalconiva" size=5 MAXLENGTH="100" value="<?= $_POST['valorsiniva3'] ?>">
                                      </FONT></td>
           						  </TR>
   						  </TBODY>
   					  </TABLE>
            			  </TD>
								
       			  </TR>
       		  </TBODY>
			</TABLE>
			
			
			
	      <p>&nbsp;</p>
			<H2 ALIGN="CENTER">Informaci&oacute;n sobre la solicitud </H2>
			<TABLE border=1 width=100%>
              <TBODY>
			  <TR bgColor=#cccccc>
            			<TD><P><FONT size=-1><B>Otros datos </B></FONT></P></TD>
   			    </TR>
                <TR>
                  <TD><TABLE align=center border=0 width="100%">
                      <TBODY>
                        <TR>
                          <TD width="50%"><font size="-1">Observaciones</font></TD>
                          <TD width="50%"><textarea name="observaciones" cols=40></textarea></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Condiciones generales </font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=condicionesgenerales ID="condicionesgenerales" size=54 MAXLENGTH="100" value="<?= $_POST['condicionesgenerales'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Tiempo de entrega(en d&iacute;as) </font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=tiempodeentrega ID="tiempodeentrega" size=54 MAXLENGTH="100" value="<?= $_POST['tiempodeentrega'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Forma de pago </font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=formadepago ID="formadepago" size=54 MAXLENGTH="100" value="<?= $_POST['formadepago'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Garant&iacute;a</font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=garantia ID="garantia" size=54 MAXLENGTH="100" value="<?= $_POST['garantia'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Lugar de entrega </font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=lugardeentrega ID="lugardeentrega" size=54 MAXLENGTH="100" value="<?= $_POST['lugardeentrega'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Sede</font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=sede ID="sede" size=54 MAXLENGTH="100" value="<?= $_POST['garantia'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Edificio</font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=edificio ID="edificio" size=54 MAXLENGTH="100" value="<?= $_POST['garantia'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Espacio</font></TD>
                          <TD><FONT size=-1>
                            <INPUT name=espacio ID="espacio" size=54 MAXLENGTH="100" value="<?= $_POST['garantia'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Elaborado por </font></TD>
                          <TD><FONT size=-1>
                            <input name=autor id="autor" size=54 maxlength="100" value="<?= $_POST['autor'] ?>">
</FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1">Jefe de Secci&oacute;n/Coordinador de &Aacute;rea/ Jefe de Departamento</font></TD>
                          <TD><FONT size=-1>
                            <input name=jefedeseccion id="jefedeseccion" size=54 maxlength="100" value="<?= $_POST['jefedeseccion'] ?>">
                          </FONT></TD>
                        </TR>
                        <TR>
                          <TD><font size="-1"> Jefe de Unidad (Divisi&oacute;n/Jefe de Oficina/Director de Escuela)</font></TD>
                          <TD><FONT size=-1>
                            <input name=jefedeunidad id="jefedeunidad" size=54 maxlength="100" value="<?= $_POST['jefedeunidad'] ?>">
                          </FONT></TD>
                        </TR>
                      </TBODY>
                  </TABLE></TD>
                </TR>
              </TBODY>
            </TABLE>			
			<p>&nbsp;</p>
			
	  </TD>
	</TR>
	<TR>
		<TD><CENTER>
                 <BR>
				 <TABLE  BORDER="0">
                 	<TR>
                 		<TD><INPUT NAME="Submit" TYPE="submit" VALUE="Enviar Formulario"></TD>
                 		<TD><INPUT TYPE="reset" VALUE="Borrar todo"></TD>
           		   </TR>
       	  </TABLE>
					<BR>
        </CENTER></TD>
	</TR>
</TABLE>
</FORM>