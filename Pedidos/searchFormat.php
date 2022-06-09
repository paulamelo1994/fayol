<script language="javascript" type="text/javascript">
	function validateDates()
	{
		if((document.searchForm.diaAntes.value!="" || document.searchForm.mesAntes.value!="" || document.searchForm.anoAntes.value!="") && (document.searchForm.diaAntes.value=="" || document.searchForm.mesAntes.value=="" || document.searchForm.anoAntes.value==""))
		{
			alert("Debe escribir una fecha completa en el campo 'Ver pedidos realizados antes de'");
			return false;
		}
		if((document.searchForm.diaDespues.value!="" || document.searchForm.mesDespues.value!="" || document.searchForm.anoDespues.value!="") && (document.searchForm.diaDespues.value=="" || document.searchForm.mesDespues.value=="" || document.searchForm.anoDespues.value==""))
		{
			alert("Debe escribir una fecha completa en el campo 'Ver pedidos realizados después de'");
			return false;
		}
		return true;
	}
	
	function validateForm()
	{
		if(!validateDates())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
</script>

<form onSubmit="return validateForm()" method="post" name="searchForm" action="index.php?item=4">
<H2 ALIGN="CENTER">B&uacute;squeda por fecha </H2>
<TABLE width=100% border=1>
  <TBODY>
    <TR bgColor=#cccccc vAlign=top>
      <TD width="61%"><P><FONT size=-1><b>B&uacute;squeda por fecha de realizaci&oacute;n </b></FONT></P></TD>
    </TR>
    <TR vAlign=top>
      <TD><TABLE width="100%" border=0 align=center>
          <TBODY>
            <TR>
              <TD width="67%"><font size="-1">Ver solo &oacute;rdenes de pedido </font></TD>
              <TD width="7%"><FONT size=-1>
                <center>
                  <font size="-1">Vigentes</font>
                </center>
              </FONT></TD>
              <TD width="4%"><FONT size=-1>
                <center><INPUT name="anuladas" type=radio 
            value=2></center>
              </FONT></TD>
              <TD>&nbsp;</TD>
              <TD width="7%"><FONT size=-1>
                <center>
                  <font size="-1">Anuladas</font>
                </center>
              </FONT></TD>
              <TD width="4%"><FONT size=-1>
               <center><INPUT name="anuladas" type=radio 
            value=1></center>
              </FONT></TD>
            </TR>
            <TR>
              <TD width="67%" rowspan="2"><FONT size=-1>Ver pedidos realizados antes de(DD/MM/AAAA)</FONT></TD>
              <TD colspan="2"><div align="center"><FONT size=-1>D&iacute;a
                </FONT></div></TD>
              <TD width="11%"><div align="center"><font size="-1">Mes</font></div></TD>
              <TD colspan="2"><div align="center"><font size="-1">A&ntilde;o</font></div></TD>
            </TR>
            <TR>
              <TD colspan="2"><div align="center"><FONT size=-1>
                  <input name="diaAntes" type="text" id="diaAntes" size="5">
              </FONT></div></TD>
              <TD><div align="center"><FONT size=-1>
                  <input name="mesAntes" type="text" id="mesAntes" size="5">
              </FONT></div></TD>
              <TD colspan="2"><div align="center"><FONT size=-1>
                  <input name="anoAntes" type="text" id="anoAntes" size="5">
              </FONT></div></TD>
              </TR>
            <TR>
              <TD rowspan="2"><FONT size=-1>Ver pedidos realizados despu&eacute;s de(DD/MM/AAAA)</FONT></TD>
              <TD colspan="2"><div align="center"><FONT size=-1>D&iacute;a </FONT></div></TD>
              <TD><div align="center"><font size="-1">Mes</font></div></TD>
              <TD colspan="2"><div align="center"><font size="-1">A&ntilde;o</font></div></TD>
            </TR>
            <TR>
              <TD colspan="2"><div align="center"><FONT size=-1>
                  <input name="diaDespues" type="text" id="diaDespues" size="5">
              </FONT></div></TD>
              <TD><div align="center"><FONT size=-1>
                  <input name="mesDespues" type="text" id="mesDespues" size="5">
              </FONT></div></TD>
              <TD colspan="2"><div align="center"><FONT size=-1>
                  <input name="anoDespues" type="text" id="anoDespues" size="5">
              </FONT></div></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
    </TR>
  </TBODY>
</TABLE>
<H2 ALIGN="CENTER">&nbsp;</H2>
<H2 ALIGN="CENTER">B&uacute;squeda por informaci&oacute;n del solicitante </H2>
<TABLE width=100% border=1>
            	<TBODY>
            		<TR bgColor=#cccccc vAlign=top>
            			<TD width="61%"><P><FONT size=-1><b>B&uacute;squeda por informaci&oacute;n del solicitante </b></FONT></P></TD>
       			  </TR>
            		<TR vAlign=top>
            			<TD><TABLE width="100%" border=0 align=center>
            					<TBODY>
            						<TR>
            							<TD width="29%"><FONT size=-1>Tipo de solicitud</FONT></TD>
            							<TD width="71%"><FONT size=-1>
            							  <INPUT name="tipo" type=radio 
            value='compra'>
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
                                      <TD><FONT size=-1>Nit</FONT></TD>
                                      <TD><INPUT name=nit size=45 MAXLENGTH="100" value="<?= $_POST['nit'] ?>">
                                      </TD>
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
		  
		  
		  
		  
          <H2 ALIGN="CENTER">B&uacute;squeda por descripci&oacute;n de la solicitud </H2>
          <TABLE width=100% border=1>
            <TBODY>
              <TR bgColor=#cccccc>
                <TD><FONT size=-1><b>B&uacute;squeda por descripci&oacute;n  de la solicitud</b></FONT></TD>
              </TR>
              <TR>
                <TD height="285"><TABLE align=center border=0 width="100%">
                  <TR>
                    <TD><font size="-1">N&uacute;mero de solicitud </font></TD>
                    <TD><INPUT NAME=numero ID="numero" SIZE=30 MAXLENGTH="100" value="<?= $_POST['numero'] ?>"></TD>
                  </TR>
                    <TBODY>
                      <TR>
                        <TD><FONT size=-1> Dep</FONT></TD>
                        <TD width="50%"><INPUT NAME=dep ID="dep" SIZE=30 MAXLENGTH="100" value="<?= $_POST['dep'] ?>"></TD>
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
                </TABLE>
                  <p>&nbsp;</p>
                  <TABLE  BORDER="0" align="center">
                    <TR>
                      <TD><INPUT NAME="Submit" TYPE="submit" VALUE="Buscar &oacute;rdenes de pedido"></TD>
                      <TD><INPUT TYPE="reset" VALUE="Borrar formulario"></TD>
                    </TR>
                  </TABLE>
                <p>&nbsp;</p></TD>
              </TR>
            </TBODY>
          </TABLE>
</form>
