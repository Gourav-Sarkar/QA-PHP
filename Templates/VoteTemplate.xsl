<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : VoteTemplate.xsl
    Created on : July 3, 2013, 10:48 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
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
                <xsl:when test="hasVoted &gt; 0 or hasVoted='' " >
                    <a>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="parent::*" />
                                <xsl:with-param name="action">upvote</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-chevron-up icon-4x" />
                    </a>
                </xsl:when>
                <xsl:otherwise>
                    <i class="icon-chevron-up icon-4x" />
                </xsl:otherwise>
            </xsl:choose>
           
            
            <p class="text-center lead" style="margin:0px">
                <xsl:value-of select="php:function('utility::formatVote',votes)" />
            </p>
            
            <xsl:choose>
                <xsl:when test="hasVoted &lt; 0 or hasVoted='' ">
                    <a>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="parent::*" />
                                <xsl:with-param name="action">downvote</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-chevron-down icon-4x" />
                    </a> 
                </xsl:when> 
                <xsl:otherwise>
                    <i class="icon-chevron-down icon-4x" />
                </xsl:otherwise>
            </xsl:choose>
            
            
        </div>
    </xsl:template>
    
    
    
    
    
    <xsl:template match="VoteStorage" mode="comment">
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
            <i class="icon-chevron-up" />
        </a>
        <span class="text-center" style="margin:0px">
            <small><xsl:value-of select="votes" /></small>
        </span>
        <a>
            <xsl:attribute name="href">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="currentNode" select="parent::*" />
                    <xsl:with-param name="action">downvote</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            <i class="icon-chevron-down" />
        </a> 
        </div>
    </xsl:template>

</xsl:stylesheet>
