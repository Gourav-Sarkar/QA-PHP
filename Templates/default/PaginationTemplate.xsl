<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : PaginationTemplate.xsl
    Created on : February 12, 2014, 8:28 PM
    Author     : gourav sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="pagination">
        <xsl:param name="i">0</xsl:param>
        <div class="pagination">
            <ul> 
                <li>
                    <xsl:value-of select="page" />
                    <xsl:if test="number(page)=1">
                        <xsl:attribute name="class">active</xsl:attribute>
                    </xsl:if>
                    <a href="#">Prsev</a>
                </li>
                <li>
                    
                    <xsl:if test="page">
                        <xsl:attribute name="class">active</xsl:attribute>
                    </xsl:if>
                    <a href="#">1</a>
                </li> 
                <li>
                    <xsl:if test="number(page)=number(totalpage)">
                        <xsl:attribute name="class">disabled</xsl:attribute> 
                        <a href="#">next</a> 
                    </xsl:if>
                    <a href="#">next</a> 
                </li>
            </ul>
        </div>
    </xsl:template>

</xsl:stylesheet>
