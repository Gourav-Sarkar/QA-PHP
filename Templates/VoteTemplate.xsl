<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : VoteTemplate.xsl
    Created on : July 3, 2013, 10:48 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="votes">
        <div>
            <a class="btn" href="">
                up vote
            </a>
            <p class="text-center lead" style="margin:0px">
                <xsl:value-of select="votes" />
            </p>
            <a class="btn" href="">
                down vote
            </a>
                             
        </div>
    </xsl:template>

</xsl:stylesheet>
