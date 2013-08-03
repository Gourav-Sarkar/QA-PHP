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
            <div class="span11 inline-edit-group">
                <p>
                    <!--Vote interface -->
                    <xsl:apply-templates select="VoteStorage" mode="comment" />
                    
                    <span class="inline-edit-field" data-field-name="content" data-field-type="text">
                        <xsl:value-of select='content' ></xsl:value-of>
                    </span>
                    -
                    <span>
                        <xsl:value-of select='time' ></xsl:value-of>
                    </span>
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">edit</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <span>Edit</span>
                    </a>
                    
                     <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">delete</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <span>delete</span>
                    </a>
                    
                     <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">flag</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <span>flag</span>
                    </a>
                    
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
        <form method="post">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="currentNode" select="." />
                    <xsl:with-param name="action">addComment</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <textarea name="content" class="span12"></textarea>
            <input type="submit" name="comment" value="comment" />
        </form>
    </xsl:template>
    
    
</xsl:stylesheet>
