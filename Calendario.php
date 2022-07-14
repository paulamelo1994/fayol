<?php ?>
            <script language="JavaScript">

            <!-- Begin
            var week = new Array("D", "L", "M", "Mi", "J", "V", "S");
            var monthdays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            var monthnames = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var today = new Date();
            var month = today.getMonth();
            var day = today.getDay();
            var dayN = today.getDate();
            var days = monthdays[month];
            if (month == 1) {
              var year = today.getYear();
              if (year%4 == 0) days = 29;
            }
            document.write("<table width='100px' bgcolor='#F2F2F2'>");
            document.write("<tr>");
            document.write("<td colspan='7' height='17px' > <font color=#333333><b>");
            document.write("<div align='center'>"+monthnames[month]+" - "+today.getFullYear() +"</div>");
            document.write("</b></font></td>");
            document.write("</tr>");
            document.write("<tr>");
            for (var i=0; i<7; i++) {
              document.write("<td width='7px' height='17px'><font color=#333333><b> " );
              document.write("<div align='center'>" + week[i] + "</div>");
              document.write("</b></font></td>");
            }
            document.write("</tr>");
            var jumped = 0;
            var inserted = 1;
            var start = day - dayN%7 + 1;
            if (start < 0) start += 7;
            var weeks = parseInt((start + days)/7);
            if ((start + days)%7 != 0) weeks++;
            for (var i=weeks; i>0; i--) {
              document.write("<tr>");
              for (var j=7; j>0; j--) {
                document.write("<td><font color=#333333><b>");
                if (jumped<start || inserted>days) {
                  document.write("<div align='center'></div>");
                  jumped++;
                }
                else {
                  if (inserted == dayN) document.write("<div align='center' ><font color='#cc0000'>" + inserted + "</font></div>");
                  else document.write("<div align='center'>" + inserted + "</div>");
                  inserted++;
                }
                document.write("</b></font></td>")
              }
              document.write("</tr>");
            }
            document.write("</table>");
            //  End -->
            </script>

<? ?>
