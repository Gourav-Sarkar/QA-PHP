<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : AnswerTemplate.xsl
    Created on : June 25, 2013, 4:36 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
    <xsl:output method="html"/>

    <!--
    # Template Answer
    # Mode  Default
    # Used to show answer in detailed mode
    -->
    <xsl:template match="answer">
        <div class="container-fluid" >
            
            <xsl:attribute name="id">
                <xsl:text>answer-</xsl:text><xsl:value-of select="id" />
            </xsl:attribute>
                
            
        <div class="row-fluid span1">
        
            <!--Vote interface -->
            <xsl:apply-templates select="VoteStorage" />
            
            <!-- Select answer interface -->
            <input class="custom-radio" type="radio" name="selectedAnswer" />
            
            <!--Quick tool interface -->
            <p>
                <a href="#">
                    <i class="icon-star-empty icon-2x mod-btn"></i>
                </a>
            </p>
        
        </div>
                    
    <div class="row-fluid span11">
        <div class="row-fluid">
             <p class="lead"><xsl:value-of select="content" /></p>
            <hr/>
        </div>
         
        <div class="row-fluid">
            <div class="span6">
                Foobar
            </div>
            <div class="offset1 span5">
                <!-- user could have nested values -->
                <xsl:apply-templates select="user" mode="inline-summary"/>
            </div>
        </div>
        
        
        <div class="span12">
            <!--Comment list --> 
            <div>  
                
                <xsl:attribute name="id">
                <xsl:text>AnswerCommentStorage-</xsl:text><xsl:value-of select="id" />
                </xsl:attribute>
                
                <xsl:apply-templates select="CommentStorage" />
            </div>
            
             <xsl:call-template name="commentForm" >
                <xsl:with-param name="holder"> 
                    <xsl:text>AnswerCommentStorage-</xsl:text>
                    <xsl:value-of select="id" />
                </xsl:with-param>
                <xsl:with-param name="formID">
                  <xsl:text>AnswerCommentForm-</xsl:text>
                    <xsl:value-of select="id" />
                </xsl:with-param>
            </xsl:call-template>
            
        </div>
        
    </div>
</div>
    </xsl:template>
    
    
    
    
    
    <!--
    # Template Answer
    # Mode BestAnswer
    # Used to format best answer look and feel
    #
    # Default: Could be used as copy of Answer default mode template
    -->
    <!--
    <xsl:template  match="bestAnswer">
     <div class="span6 container-fluid">
    <div class="span1">
        <img src="/image/avatar/anonymousUserAvatar.png" class="img-rounded" />
        <p class="text-center text-success">31</p>
    </div>
                    
    <div class="span11">
        <p class="lead"><?php echo $this->getContent();?></p>
        <hr>
    </div>
    </div>    
        
    </xsl:template>
    -->
   


    <!-- Answer form -->
    <!--
    <xsl:template>
        <form action="/stackoverflow/index.php?module=question&action=answer&question=<?php echo $_GET['question']; ?>" method="post">
    <textarea class="span12" name="answer">
    Answering question
    </textarea>
    <input type="submit" name="Answer" value="Answer" />
    </form>
    </xsl:template>
    -->
    <!-- ========================================================================-->




    <!-- Template Answer form -->
    <xsl:template name="answerForm">
        <form method="post" id="answerForm">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="currentNode" select="." />
                    <xsl:with-param name="action">answer</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <textarea class="span12" name="answer">
                Answering question
            </textarea>
            <input type="submit" name="Answer" value="Answer" class="btn" data-loading-text="Answering.." data-holder="#answerStorage" data-form="#answerForm">
                <xsl:attribute name="data-target">
                    <xsl:value-of select="local-name(.)" />
                    <xsl:text>-</xsl:text>
                    <xsl:value-of select="id" />
                </xsl:attribute>
            </input>
        </form>
    </xsl:template>
    



</xsl:stylesheet>
