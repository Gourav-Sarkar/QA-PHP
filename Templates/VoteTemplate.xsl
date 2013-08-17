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
            <!--
            Conditional check for vote
            It test if current user has voted already or not
            If it is negetive number user had Down Voted if positive user UPvoted
            -->
            <xsl:choose>
                <xsl:when test="hasVoted &gt; 0">
                    <b>Has UpVoted</b>
                </xsl:when>
                <xsl:when test="hasVoted &lt; 0">
                    <b>Has downVoted</b>
                </xsl:when>
            </xsl:choose>
            
            
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
