<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : VoteTemplate.xsl
    Created on : July 3, 2013, 10:48 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="VoteStorage">
        <div>
            <xsl:if test="hasVoted!=''">
                <b>Has Voted</b>    
            </xsl:if>
            
            <a>
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="parent::*" />
                        <xsl:with-param name="action">upvote</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <span>Upvote</span>
            </a>
            <p class="text-center lead" style="margin:0px">
                <xsl:value-of select="votes" />
            </p>
            <a>
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="parent::*" />
                        <xsl:with-param name="action">downvote</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <span>Downvote</span>
            </a> 
        </div>
    </xsl:template>
    
    
    
    
    
    <xsl:template match="VoteStorage" mode="comment">
        <span>
            <a>
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="parent::*" />
                        <xsl:with-param name="action">upvote</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <span>U</span>
            </a>
            <span class="text-center lead" style="margin:0px">
                <xsl:value-of select="votes" />
            </span>
            <a>
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="parent::*" />
                        <xsl:with-param name="action">downvote</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <span>D</span>
            </a> 
        </span>
    </xsl:template>

</xsl:stylesheet>
