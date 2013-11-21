<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : campaignTemplate.xsl
    Created on : September 30, 2013, 8:10 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="campaign">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="offset1 span9">
                    <div class="row-fluid">
                        <!-- -->
                        <div class="span3">
                            <div class="row-fluid">
                                
                            </div>
                        </div>
                        
                        <!-- -->
                        <div class="offset1 span8">
                            <h1>
                                <xsl:value-of select="title" />
                            </h1>
                            <p>
                                <xsl:value-of select="content" />
                            </p>
                            
                            <div class="row-fluid">
                                <xsl:apply-templates select="user" mode="inline-summary"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- campaign stat -->
            <div class="row-fluid">
                <div class="offset1 span9">
                    <a href="#" class="btn btn-large btn-primary">Download</a>
                </div>
            </div>
        </div>
    </xsl:template>

</xsl:stylesheet>
