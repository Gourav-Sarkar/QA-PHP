<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : CommentTemplates.xsl
    Created on : June 25, 2013, 11:05 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
    <xsl:output method="html"/>

    <!-- 
    # Template comment
    # Mode Default
    # Used to show default comments
    -->
    <xsl:template match="answercomment">
        <div class="row-fluid">
            <div class="span11 inline-edit-group">
                <!--Vote interface -->
                <span class="pull-left">
                    <xsl:apply-templates select="VoteStorage" mode="comment" />
                </span>
                    
                <!--User Interface -->
                <span class="pull-left text-center">
                    <xsl:apply-templates select="user" mode="inline-min-summary" />
                    <span class="inline-edit-field" data-field-name="content" data-field-type="text">
                        <xsl:value-of select='content' ></xsl:value-of>
                    </span>
                    -
                    <span>
                        <xsl:value-of select="php:function('utility::timeDiff',time)" />
                    </span>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">edit</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-edit"></i>
                    </a>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">delete</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-remove"></i>
                    </a>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">flag</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-flag"></i>
                    </a>
                    
                </span>
            </div>
        </div>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
    <!-- 
    # Template comment for Question
    # Mode Default
    # Used to show default comments
    -->
    <xsl:template match="questioncomment">
        <div class="row-fluid">
            <div class="span11 inline-edit-group">
                <!--Vote interface -->
                <span class="pull-left">
                    <xsl:apply-templates select="VoteStorage" mode="comment" />
                </span>
                    
                <!--User Interface -->
                <span class="pull-left text-center">
                    <xsl:apply-templates select="user" mode="inline-min-summary" />
                    <span class="inline-edit-field" data-field-name="content" data-field-type="text">
                        <xsl:value-of select='content' ></xsl:value-of>
                    </span>
                    -
                    <span>
                        <xsl:value-of select="php:function('utility::timeDiff',time)" />
                    </span>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">edit</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-edit"></i>
                    </a>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">delete</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-remove"></i>
                    </a>
                    
                    <a class="inline-edit-button">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">flag</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-flag"></i>
                    </a>
                    
                </span>
            </div>
        </div>
    </xsl:template>
    <!-- ========================================================================-->
 
    
    <!--
    # Template CommentStorage
    # Holds list of comment
    -->
    <xsl:template match="CommentStorage">
        <!-- 
        # select elements which are stored in commentStorage
        # Add more element to represent storeble object in commentStorage
        # incase elements needs seperate Storage remove the related element and
        # implement it in seperate Storage template
        -->
        <xsl:apply-templates select="questioncomment | answercomment" />
    </xsl:template>
    <!-- ========================================================================-->    
    
    
    
    
    <xsl:template name="commentForm">
        <xsl:param name="holder"/>
        <xsl:param name="formID"/>
        
        <form method="post">
            <!-- uniqly identify form -->
            <xsl:attribute name="id">
                <xsl:value-of select="$formID" />
            </xsl:attribute>
            
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="currentNode" select="." />
                    <xsl:with-param name="action">addComment</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <textarea name="content" class="span12">
                <xsl:value-of select="id" />
            </textarea>
            
            <input type="submit" data-loading-text="Commenting.." class="btn" name="comment" value="comment">
                <!-- Place holder of reponse data. points to a unique id -->
                <xsl:attribute name="data-holder">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select="$holder" />
                </xsl:attribute>
                
                <!-- same as form id to uniqly identify form -->
                <xsl:attribute name="data-form">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select="$formID" />
                </xsl:attribute>
                
                
                <xsl:attribute name="data-target">
                    <xsl:value-of select="local-name(.)" />
                    <xsl:text>-</xsl:text>
                    <xsl:value-of select="id" />
                </xsl:attribute>
            </input>
        </form>
    </xsl:template>
    
    
</xsl:stylesheet>
