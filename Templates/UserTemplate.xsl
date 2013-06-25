<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : UserTemplate.xsl
    Created on : June 25, 2013, 4:25 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="user" mode="summary">
        <div class="owner">
        <a href="#">
            <img src="#" class="img-rounded"/>
        </a>
        <div class="text-center">
            <h4>
                <xsl:value-of select="nick" />
            </h4>
        </div>
</div>
    </xsl:template>

</xsl:stylesheet>
