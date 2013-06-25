<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : AnswerTemplate.xsl
    Created on : June 25, 2013, 4:36 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="answer">
        <div class="container-fluid">
        <div class="row-fluid span1">
            <img src="/image/avatar/default.png" class="img-rounded" />
        
        <!--Vote interface -->
        <!--
        <div class="span12">
            <a href="<?php echo $this->getLink("upvote"); ?>">
                <img src="/image/icon/ui/arrow-up-64.png" />
            </a>
            <p class="text-center lead" style="margin:0px">34k</p>
            <a href="<?php echo $this->getLink("downvote"); ?>">
                <img src="/image/icon/ui/arrow-down-64.png" />
            </a>
        </div>
        -->
        
    </div>
                    
    <div class="row-fluid span11">
        <p class="lead"><xsl:value-of select="content" /></p>
        <hr/>
        
        <div class="row-fluid">
            <!--
            Action link/button goes here
            <a href="<?php echo $this->getLink("edit"); ?>"><span>Edit</span></a>
            <a href="<?php echo $this->getLink("delete"); ?>">Delete</a>
            -->
        </div>
        
        <div class="span12">
            <xsl:apply-templates match="comment" />
            <br/>
        </div>
        
    </div>
</div>
    </xsl:template>

</xsl:stylesheet>
