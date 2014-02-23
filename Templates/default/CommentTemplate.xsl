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
      
    <!-- 
    # Template comment for Question
    # Mode Default
    # Used to show default comments
    -->
    <xsl:template match="answercomment | questioncomment |articlecomment">
        <div class="row-fluid">
            
            <xsl:attribute name="id">
                <xsl:value-of select="local-name(.)"></xsl:value-of>
                <xsl:text>-</xsl:text>
                <xsl:value-of select="id"></xsl:value-of>
            </xsl:attribute>
            
            
            <div class="span11 inline-edit-group">
                <!--Vote interface -->
                <xsl:apply-templates select="VoteStorage" mode="comment" />
                    
                <!--User Interface -->
                <xsl:apply-templates select="user" mode="inline-min-summary" />
                    
                <!-- inline editeble content -->
                <span class="inline-edit-form">
                    <span class="inline-edit" data-type="text">
                        
                        <xsl:value-of select='content' ></xsl:value-of>
                    </span>
                </span>
                -
                <span>
                    <xsl:value-of select="php:function('utility::timeDiff',time)" />
                </span>
                    
                <!-- prefix with target tells it is class targeting nodes -->
                <div class="btn-group">
                    <xsl:attribute name="data-target-object">
                        <xsl:value-of select="local-name(.)"></xsl:value-of>
                        <xsl:text>-</xsl:text>
                        <xsl:value-of select="id"></xsl:value-of>
                    </xsl:attribute>
            
                    <a class="btn btn-mini btn-inline-edit" data-inline-edit-target=".inline-edit-field-content" >
                        
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">edit</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-edit"></i>
                    </a>
                    
                    <a class="btn btn-mini btn-confirm" data-btn-msg="Are you really sure to delete this?">
                        <xsl:attribute name="href" >
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">delete</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-remove"></i>
                    </a>
                    
                    <a class="btn btn-mini">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">flag</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <i class="icon-flag"></i>
                    </a>
                </div>
            </div>
        </div>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
    <!-- 
    # Template comment for Question
    # Mode Default
    # Used to show default comments
    -->
   <!-- removed -->
    <!-- ========================================================================-->
 
    
    <!--
    # Template CommentStorage
    # Holds list of comment
    defaulr comment storeage
    -->
    <xsl:template match="CommentStorage">
        <!-- 
        # select elements which are stored in commentStorage
        # Add more element to represent storeble object in commentStorage
        # incase elements needs seperate Storage remove the related element and
        # implement it in seperate Storage template
        -->
        <!--
        <xsl:param name="foo">ss</xsl:param>
        <xsl:value-of select="$foo" />
        -->
        <xsl:apply-templates select="questioncomment | answercomment | articlecomment" />
    </xsl:template>
    <!-- ========================================================================-->    
    
    
    
    
    <xsl:template name="commentForm">
        <!-- Where the data will be inserted -->
        <xsl:param name="holder"/>
        <!-- target of Form id which will be -->
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
            
            <input type="submit" data-loading-text="Commenting.." class="btn realTime" name="comment" value="comment">
                <!-- Place holder of reponse data. points to a unique id -->
                <xsl:attribute name="data-holder">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select="$holder" />
                </xsl:attribute>
                
                <!--
                same as form id to uniqly identify form 
                @deprecated No need form id. closest form will be targeted
                -->
                <!--
                <xsl:attribute name="data-form">
                    <xsl:text>#</xsl:text>
                    <xsl:value-of select="$formID" />
                </xsl:attribute>
                -->
                
                <!--
                # Have no any use
                -->
                <!--
                <xsl:attribute name="data-target">
                    <xsl:value-of select="local-name(.)" />
                    <xsl:text>-</xsl:text>
                    <xsl:value-of select="id" />
                </xsl:attribute>
                -->
            </input>
        </form>
    </xsl:template>
    
    
</xsl:stylesheet>
