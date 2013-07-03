<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : CommentTemplates.xsl
    Created on : June 25, 2013, 11:05 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- 
    # Template comment
    # Mode Default
    # Used to show default comments
    -->
    <xsl:template match="comment">
        <div class="row-fluid">
            <div class="span11">
                <p>
                    <xsl:value-of select='content' ></xsl:value-of>
                    -
                    <span>
                        <xsl:value-of select='time' ></xsl:value-of>
                    </span>
                    <!--
                    <span class="btn-group">
                    <a href="<?php echo $this->getLink("edit"); ?>">
                        <i class='icon-edit'></i>
                    </a>
                    <a href="<?php echo $this->getLink("delete"); ?>">
                        <i class='icon-remove'></i>
                    </a>
                    <a href="<?php echo $this->getLink("flag"); ?>">
                        <i class='icon-flag'></i>
                    </a>
                    <b><?php //echo $this->getLink("delete"); ?></b>
                    </span>
                    -->
                </p>
            </div>
        </div>
    </xsl:template>
    <!-- ========================================================================-->
 
    
    <!--
    # Template CommentStorage
    # Holds list of comment
    -->   
    
    <xsl:template match="CommentStorage">
        <xsl:apply-templates select="comment" />
    </xsl:template>
    <!-- ========================================================================-->    
    
    
    
    
    <xsl:template name="commentForm">
        <form action="#" method="post">
            <textarea name="content" class="span12"></textarea>
            <input type="submit" name="comment" value="comment" />
        </form>
    </xsl:template>
    
    
</xsl:stylesheet>
