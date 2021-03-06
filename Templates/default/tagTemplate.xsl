<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : tagTemplate.xsl
    Created on : June 27, 2013, 8:37 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!--
    # Template Tag
    # mode Inline (@todo)
    # used to show inline tag information. very short tag information
    -->
    <xsl:template match="tag">
        <a href="#">
            <span class="badge badge-info">
                <xsl:value-of select="name" />
            </span>
        </a>
    </xsl:template>
    

</xsl:stylesheet>
