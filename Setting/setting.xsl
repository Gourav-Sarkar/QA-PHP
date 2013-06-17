<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : Admin-panel.xsl
    Created on : June 15, 2013, 9:25 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" doctype-system="about:legacy-compat" omit-xml-declaration="yes" encoding="UTF-8" indent="yes"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    
    
    <!-- content of tab -->
    <xsl:template match="*[@type='toggle']">
        <div class ="row-fluid">
            <h4>
                <xsl:value-of select="@heading" /> 
                <small>
                     <xsl:value-of select="@meta" />
                </small>
            </h4>
            <div class="switch switch-small">
                <input type="checkbox">
                    <xsl:if test="boolean(text())">
                        <xsl:attribute name="checked" />
                    </xsl:if> 
                </input>
            </div>    
        </div>
        
    </xsl:template>
    
    
    <!-- module tab content -->
    <xsl:template match="*[@type='module']" mode="tabContent">
        <div class="tab-pane" id="{local-name()}">
            <pre>
                <xsl:value-of select='local-name()' />
            </pre>
            
            <xsl:apply-templates select="*[@type='toggle']" />
        </div>
                            
    </xsl:template>
    
    <!-- module tablist -->
    <xsl:template match="*[@type='module']" mode="tab">
        <li>
            <h3 class="text-center">
                <a href="#{local-name()}" data-toggle="tab"> 
                    <xsl:value-of select="local-name()" />
                </a>
            </h3>
        </li>
    </xsl:template>
    <!-- Template for toggle -->
    
    
    <!-- template for core -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Admin Panel</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!-- Bootstrap -->
                <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css" />
                <link href="/Bootstrap/css/bootstrapSwitch.css" rel="stylesheet" media="screen" type="text/css"/>
            </head>
            <body>
                <div class="row-fluid container-fluid">
                    <h1>Admin Panel</h1>
                </div>
            
                <div class="row-fluid container-fluid">
                    <div class="span2">
                        <!-- List of all modules -->
                        <ul class="nav nav-tabs nav-stacked">
                            <xsl:apply-templates select="*" mode="tab"/>
                        </ul>
                    </div>
            
                    <div class="span10">
                        <div class="tab-content">
                            <xsl:apply-templates select="*" mode="tabContent"/>
                        </div>
                    </div>
                    
                </div>
        
                
                <script src="/jquery/jquery-min.js" type="text/javascript"></script>
                <script src="/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="/Bootstrap/js/bootstrapSwitch.js" type="text/javascript"></script>
                <script src="js/realtime.js" type="text/javascript"></script>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
