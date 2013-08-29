<?xml version="1.0"?>

<!--
    Document   : StaticTemplate.xsl
    Created on : July 27, 2013, 5:42 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
         
         Add template of each static page
         Static pages are those who does not have database data
    -->
    <xsl:template match="pageRoot[@static='staticUserLogin']" mode="static">
        <div class="container-fluid">
            <div class="row-fluid offset2 span8">
                <div class="row-fluid offset1 span4">
                    <xsl:call-template name="user-register-form" />
                </div>
                <div class="row-fluid offset1 span4">
                    <xsl:call-template name="user-login-form" />
                </div>
            </div>
        </div>
    </xsl:template>

</xsl:stylesheet>
