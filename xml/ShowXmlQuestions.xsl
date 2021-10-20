<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <HTML><BODY>
                <P>NOLA BIHURTU XML DOKUMENTUA HTML TAULA BATEAN</P>
                <TABLE border="1" bgcolor="#66ff66">
                    <THEAD><TR><TH>Egilea</TH><TH>Gaia</TH><TH>Enuntziatua</TH><TH>Erantzuna</TH><TH>Faltsuak</TH></TR></THEAD>
                    <xsl:for-each select="/assessmentItems/assessmentItem" >
                        <TR>
                            <TD><FONT SIZE="2" FACE="Verdana">
                                    <xsl:value-of select="@author"/> <BR/>
                                </FONT>
                            </TD>
                            <TD>
                                <FONT SIZE="2" FACE="Verdana">
                                    <xsl:value-of select="@subject"/> <BR/>
                                </FONT>
                            </TD>
                            <TD>
                                <FONT SIZE="2" FACE="Verdana">
                                    <xsl:value-of select="itemBody/p"/> <BR/>
                                </FONT>
                            </TD>
                            <TD>
                                <FONT SIZE="2" FACE="Verdana">
                                    <xsl:value-of select="correctResponse/response"/> <BR/>
                                </FONT>
                            </TD>
                            <TD>
                                <FONT SIZE="2" FACE="Verdana">
                                    <xsl:for-each select="incorrectResponses/response">
                                        
                                            <xsl:value-of select="text()"/><BR/>
                                        
                                    </xsl:for-each>
                                </FONT>
                            </TD>
                        </TR>
                    </xsl:for-each>
                </TABLE>
            </BODY></HTML></xsl:template>
</xsl:stylesheet>