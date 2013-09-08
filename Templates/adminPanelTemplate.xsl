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
    
    
    <!-- 
    content of tab 
    Handle toggle
    -->
    <!--
    
    <xsl:template match="*[@field='toggle']">
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
    -->
       
       
    <xsl:template match="*[@type='text']">
        <xsl:value-of select='@name' />
        <div class="row-fluid">
            <h4> 
                <xsl:value-of select="@heading" /> 
            </h4>
            <a href="#">
                <xsl:value-of select="." /> 
            </a>
        </div>
    </xsl:template>
    
    <!-- module tab content -->
    <xsl:template match="module" mode="tabContent">
        <div class="tab-pane">
            <xsl:attribute name="id">
                <xsl:value-of select='@name' />
            </xsl:attribute>
            
            
            <pre>
                <xsl:value-of select='@name' />
            </pre>
            
            <!-- sub tab -->
            <ul class="nav nav-tabs">
                <xsl:apply-templates select="module" mode="tab"/>
            </ul>
            <div class="tab-content">
                <xsl:apply-templates select="module" mode="tabContent"/>
                
                <!-- [CAUTION] -->
                <!-- Select child node which is not module -->
                <xsl:apply-templates select="child::*[local-name()!='module']" />
            </div>
            
        </div>
                            
    </xsl:template>
    
    <!-- module tablist -->
    <xsl:template match="module" mode="tab">
        <li>
            <a data-toggle="tab"> 
                <xsl:attribute name="href">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select='@name' />
                </xsl:attribute>
            
                <h3>
                    <xsl:value-of select="@name" />
                </h3>
            </a>
        </li>
    </xsl:template>
    <!-- Template for toggle -->
    
    
    <xsl:template match="setting">
        <div class="row-fluid">
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked">
                    <xsl:apply-templates select="child::module" mode="tab"/>
                </ul>
            </div>
            <div class="span9">
                <div class="tab-content">
                    <xsl:apply-templates select="module" mode="tabContent" />
                </div>
            </div>
        </div>
        
    </xsl:template>
    
    
    
    

</xsl:stylesheet>
