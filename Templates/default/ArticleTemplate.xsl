<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : ArticleTemplate.xsl
    Created on : June 29, 2013, 12:02 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="article">
        <xsl:call-template name="article-form" />
        <div class="container-fluid row-fluid">

            <!--Article heading -->
            <div class="row-fluid">
                <div class="offset1 span10">
                    <div class='page-header'>
                        <h1>
                            <xsl:value-of select="title" />
                            <small>
                                <xsl:value-of select="caption" />
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row-fluid">

                <!--Content Info -->
                <div class="span1">
                    <div class="text-center">
                        <img src="http://127.0.0.1/image/icon/ui/arrow-up-64.png" />
                        <h1>19k</h1>
                        <img src="http://127.0.0.1/image/icon/ui/arrow-down-64.png" />
                        <img src="http://127.0.0.1/image/icon/social/facebook.png" />
                        <img src="http://127.0.0.1/image/icon/social/twitter.png" />
                        <img src="http://127.0.0.1/image/icon/social/googleplus_red.png" />
                    </div>
                </div>

                <!--Content Area -->
                <div class="span7">
                    
                    <!--Article stat -->
                    <div class="row-fluid">
                        
                        <hr/>
                    </div>
                    
                    <!-- article conetnt -->
                    <p class="lead"> 
                        <xsl:value-of select="content" />
                    </p>

                    <hr/>
                    
                    <!-- aritcle comment -->
                    <div class="row-fluid">
                        <!-- comment form -->
                        <xsl:call-template name="commentForm" />
                    
                        <!-- Article comments -->
                        <xsl:apply-templates select="CommentStorage" />
                    
                    </div>
                </div>

                <!-- User profile -->
                <div class="span4">
                    <xsl:apply-templates select="user" mode="inline-summary" />
                </div>
            </div>
        </div>
    </xsl:template>
    
    
    
    <xsl:template match="ArticleStorage">
        <xsl:apply-templates select="article" mode="lists" />
        <xsl:apply-templates select="pager" />
    </xsl:template>
    
    <!-- 8926461407  -->
    
    <xsl:template match="article" mode="lists">
        <div class="row-fluid">
            <div class="span1">
            </div>
            <div class="span8">
                <h3>
                    <a>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="action">show</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <xsl:value-of select="title" />
                    </a>
                </h3>
                
                <p>
                    <xsl:value-of select="caption" />
                </p>
            </div>
        </div>
    </xsl:template>
     
    
    <xsl:template name="article-form">
        <form method="post" class="form-horizontal">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink"> 
                    <xsl:with-param name="module">article</xsl:with-param>
                    <xsl:with-param name="action">create</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <fieldset>
                <legend>Article</legend>
                
                <div class="control-group" >
                    <input type="text" name="title" class="span7" />
                </div> 
                <div class="control-group" >
                    <input type="text" name="caption" class="span7" />
                </div>
                <div class="control-group">
                    <textarea name="content" class="span7"></textarea>
                </div>
            
                <!-- time span of the article -->
                <!--
                <div class="control-group">
                    <label>timespan</label>
                    <span>From</span>
                    <input type="checkbox" name="draft" />
                    <span>To</span>
                    <input type="checkbox" name="draft" />
                </div>
                -->
                <!-- visibility -->
                <!-- comment enable-->
                <!-- comment Notfication -->
            
                <!-- Password encryption
                    <div class="control-group">
                        <label>Password</label>
                        <input type="text" name="locked" />
                    </div>
                -->
                <div class="control-group">
                    <input type="submit" class="btn btn-primary btn-large" name="save" value="save"/>
                </div>
                
            </fieldset>
        </form>
    </xsl:template>

</xsl:stylesheet>
