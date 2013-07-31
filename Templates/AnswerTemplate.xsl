<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : AnswerTemplate.xsl
    Created on : June 25, 2013, 4:36 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!--
    # Template Answer
    # Mode  Default
    # Used to show answer in detailed mode
    -->
    <xsl:template match="answer">
        <div class="container-fluid">
        <div class="row-fluid span1">
            <!-- user could have nested values -->
            <xsl:apply-templates select="user" mode="inline-summary"/>
        
        <!--Vote interface -->
        <!--
        <div class="span12">
            <a href="<?php echo $this->getLink("upvote"); ?>">
                <img src="/image/icon/ui/arrow-up-64.png" />
            </a>
            <p class="text-center lead" style="margin:0px">34k</p>
            <a href="<?php echo $this->getLink("downvote"); ?>">
                <img src="/image/icon/ui/arrow-down-64.png" />
            </a>
        </div>
        -->
        
    </div>
                    
    <div class="row-fluid span11">
        <p class="lead"><xsl:value-of select="content" /></p>
        <hr/>
        
        <div class="row-fluid">
            <!--
            Action link/button goes here
            <a href="<?php echo $this->getLink("edit"); ?>"><span>Edit</span></a>
            <a href="<?php echo $this->getLink("delete"); ?>">Delete</a>
            -->
        </div>
        
        <div class="span12">
            <xsl:apply-templates select="CommentStorage" />
            <br/>
            <xsl:call-template name="commentForm" />
                <xsl:call-template name="getLink">
                    <xsl:with-param name="foo" select="."></xsl:with-param>
                </xsl:call-template>
            <br/>
        </div>
        
    </div>
</div>
    </xsl:template>
    
    
    <!-- 
    # Template AnswerStorage
    # Mode Default
    # Used to hold numbers of comment
    -->
    <xsl:template match='AnswerStorage'>
        <xsl:apply-templates select="answer" />
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
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
        <form method="post">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="currentNode" select="." />
                    <xsl:with-param name="action">answer</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <textarea class="span12" name="answer">
                Answering question
            </textarea>
            <input type="submit" name="Answer" value="Answer" />
        </form>
    </xsl:template>
    



</xsl:stylesheet>
