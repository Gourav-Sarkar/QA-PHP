<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : QuestionTemplate.xsl
    Created on : June 25, 2013, 7:46 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- 
    Question template
    Mode default
    Used in detailed Question view. Like when used to view questions
    -->
    <xsl:template match ="question">
        <div class="container-fluid inline-edit-group-origin-question">
            <xsl:attribute name="id">
                <xsl:text>question-</xsl:text>
                <xsl:value-of select="id" />
            </xsl:attribute>
            
            <div class="row-fluid">
                <!-- Question Template  -->
                <h1 class="span10 page-header" data-field-name="title" data-field-type="text">
                    <xsl:value-of select="title" />
                </h1>
            </div>
            
            <div class="row-fluid">
                
                <div class="span6 container-fluid">
                    <div class="span1">
                        
                        <!--Vote interface -->
                        <xsl:apply-templates select="VoteStorage" />
                        
                    </div>
                    
                    <div class="span11">
                    
                        <!--inline edit field -->
                        <p class="lead">
                            <xsl:value-of select="content" />
                        </p>
                        <hr/>
                        
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="container-fluid">
                                    <!-- Tag template -->
                                    <xsl:apply-templates select="tagStorage/tag" />
                                </div>
                            </div>
                            <div class="offset3 span5">
                                <!-- user could have nested values -->
                                <xsl:apply-templates select="user" mode="inline-summary" />
                                <p>
                                - 
                                <xsl:value-of select="php:function('utility::timeDiff',time)" />
                                </p>
                                <!-- <xsl:value-of select="php:function('utility::getLink',String(.),'action')" /> -->
                                <!--
                                - 
                                <xsl:value-of select="time" />
                                -->
                            </div>
                        </div>
                    
                        <div class="row-fluid">
                            <!--Action link/button goes here -->
                            <a>
                                <xsl:attribute name="href">
                                    <xsl:call-template name="getLink">
                                        <xsl:with-param name="currentNode" select="." />
                                        <xsl:with-param name="action">close</xsl:with-param>
                                    </xsl:call-template>
                                </xsl:attribute>
                                <span>Close</span>
                            </a>
                            <a>
                                <xsl:attribute name="href">
                                    <xsl:call-template name="getLink">
                                        <xsl:with-param name="currentNode" select="." />
                                        <xsl:with-param name="action">delete</xsl:with-param>
                                    </xsl:call-template>
                                </xsl:attribute>
                                <span>Delete</span>
                            </a>
                            <a class="inline-edit-button" data-inline-edit-group="question">
                                <xsl:attribute name="href">
                                    <xsl:call-template name="getLink">
                                        <xsl:with-param name="currentNode" select="." />
                                        <xsl:with-param name="action">edit</xsl:with-param>
                                    </xsl:call-template>
                                </xsl:attribute>
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Comment section of Question -->
                    <div class="row-fluid offset1 span11">
                        <!--comment template goes here -->
                        <div id="QuestionCommentStorage">
                            <xsl:apply-templates select="CommentStorage" />
                        </div>
                        
                        <xsl:call-template name="commentForm" >
                            <xsl:with-param name="holder">QuestionCommentStorage</xsl:with-param>
                            <xsl:with-param name="formID">QuestionCommentForm</xsl:with-param>
                        </xsl:call-template>
                    </div>
                </div>
           
            </div>
            
            <!-- <h2>Best Answer</h2> -->
            <!-- implement later -->
        </div>
         
          
        <div class="row-fluid">
                
            <div class="offset2 span7">
                <hr/>
                        
                         
                <div class="pagination pagination-medium">
                    <ul>
                        <li>
                            <a href="#">Prev</a>
                        </li>
                        <li>
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">Next</a>
                        </li>
                    </ul>
                </div>
                <xsl:call-template name="answerForm" />
                
                <!-- Answer Storage -->
                <div id="answerStorage">
                    <xsl:apply-templates select="AnswerStorage/answer" />
                </div>
                     
            </div>
        </div>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
    <!--
    # Question storage
    # Holds question in one place
    -->
    <xsl:template match="QuestionStorage">
        <!--call Question form-->
        <xsl:call-template name="QuestionCreate">
        </xsl:call-template>
        
        <xsl:apply-templates select="question" mode="summary"/>
    </xsl:template>
    <!-- ========================================================================-->   
    
    
    
    
    
    <!--
    # Question Template
    # Mode Summary
    # Used to show question in summary mode
    -->
    <xsl:template match="question" mode="summary">
        
        <article class="row-fluid">
            <div class="span3">
                <div class="container-fluid">
                    <ul class="thumbnails">
                        <li class="span4">
                            <h3 class="text-center">13</h3>
                        </li>
                        <li class="span4">
                            <h3 class="text-center">
                                      
                            </h3>
                        </li>
                        <li class="span4">
                            <h3 class="text-center">
                                <xsl:value-of select="views" />
                            </h3>
                        </li>
                    </ul>
                </div>
            </div>
                    
            <div class="span9">
                <div class="row-fluid container-fluid">
                    <a>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="currentNode" select="." />
                                <xsl:with-param name="action">show</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <h3>
                            <xsl:value-of select="title" />
                        </h3>
                    </a>
            
                </div>
                <div class="row-fluid container-fluid">
                    <span>50 Seconds ago, By</span>
                    <a href="#">
                        Alpha
                    </a>
                </div>
            </div>
        </article>
        <hr/>    

    </xsl:template>
    <!-- ========================================================================-->
    
    <!-- form template -->
    <xsl:template name="QuestionCreate">
        <form method="post" class="form-horizontal">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink"> 
                    <xsl:with-param name="module">question</xsl:with-param>
                    <xsl:with-param name="action">ask</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            <fieldset>
                <legend>Ask Question</legend>
                <div class="control-group">
                    <label>Title</label>
                    <input class="span9" type="text" name="title" />
                </div>
                <div class="control-group">
                    <label>Question</label>
                    <textarea class="span9" name="content" rows="20"></textarea>
                </div>
                <div class="control-group">
                    <label>Tags</label>
                    <input class="span9" type="text" name="tags" />
                </div>
                <div class="control-group">
                    <input type="submit" class="btn btn-primary btn-large" name="ask" value="ask"/>
                </div>
            </fieldset>
        </form>
    </xsl:template>


</xsl:stylesheet>
