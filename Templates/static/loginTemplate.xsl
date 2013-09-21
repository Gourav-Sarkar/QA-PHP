<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : login.xsl
    Created on : September 19, 2013, 9:25 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="page[title='login']">
        <div class="row-fluid">
            
            <div class="offset1 span4">
                
                <xsl:call-template name="user-login-form"></xsl:call-template>
            </div>
            
            <div class="offset1 span4">
                <xsl:call-template name="user-register-form"></xsl:call-template>
            </div>
            
        </div>
    </xsl:template>

</xsl:stylesheet>
