<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : CampaignForm.xsl
    Created on : November 28, 2013, 5:40 PM
    Author     : gourav sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    --> 
    <xsl:template match="page[title='campaignform']">
        <div class="row-fluid">
            <xsl:call-template name="campaignform" />
            
        </div>
    </xsl:template>

</xsl:stylesheet>
