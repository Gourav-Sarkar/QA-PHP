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
    Mode details
    Used in detailed Question view. Like when used to view questions
    -->
    <xsl:template match="question">
        <div class="row-fluid container-fluid">
            <!-- Question Template  -->
                <h1 class="span10 page-header">
                    <xsl:value-of select="title" />
                </h1>
            </div>
            
        <div class="row-fluid">
                
                <div id="question" class="span6 container-fluid">
                    <div class="span1">
                        <p>
                            <xsl:apply-templates match="/user" mode="summary" />
                        </p>
                        
                        <!--Vote interface -->
                        <div>
                            <!--
                            <a class="btn" href="<?php echo $this->getLink("upvote"); ?>">
                                up vote
                            </a>
                             <p class="text-center lead" style="margin:0px"><?php echo $this->getVotes(); ?></p>
                             <a class="btn" href="<?php echo $this->getLink("downvote"); ?>">
                                 down vote
                             </a>
                             -->
                             
                        </div>
                        
                    </div>
                    
                    <div class="span11">
                        <p data-name="content" class="lead">
                            <xsl:value-of select="content" />
                        </p>
                        
                        <div class="row-fluid">
                            <div class="span7">
                                <div class="container-fluid">
                                    <!-- get tag template -->
                                    
<!--
                                    <?php echo $this->getTags()->count(); ?>
                                    <?php echo $this->getTags()->render(new Template("tag-list")); ?>
                                    -->
                                </div>
                            </div>
                            <div class="span4">
                                - 
                                <xsl:value-of select="time" />
                            </div>
                        </div>
                    
                        <div class="row-fluid">
                        <!-- Revision data -->
                        
<!--
                            <?php if($this->getRevisions()->count()):?>
                            <a href="<?php echo $this->getLink("getRevision"); ?>">Show rev</a>
                            <?php else: echo '&nbsp;'; ?>
                            <?php endif; ?>
                            -->
                       
                        </div>
                    
                        <div class="row-fluid">
                        <!--Action link/button goes here -->
                            <div class="broup">
                                <!--
                                <a href="<?php echo $this->getLink("close"); ?>">Close</a>
                                <a href="<?php echo $this->getLink("edit"); ?>">Edit</a>
                                <a href="<?php echo $this->getLink("delete"); ?>">Delete</a>
                                -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comment section of Question -->
                    <div class="row-fluid offset1 span11">
                       <!--comment template goes here -->
                       <xsl:apply-templates match="QuestionComment" mode="details" />
                    </div>
                    
                </div>
                
                
                <!-- <h2>Best Answer</h2> -->
            </div>
    </xsl:template>


<!--
Summary mode
Used to show question in summary style
-->

<!--
<xsl:template match="/question" mode="summary">
<article class="row-fluid">
    <div class="span3">
        <div class="container-fluid">
            <ul class="thumbnails">
                <li class="span4"><h3 class="text-center">13</h3></li>
                <li class="span4">
                    <h3 class="text-center">
                                      
                    </h3>
                </li>
                <li class="span4">
                    <h3 class="text-center">
                        <?php echo $this->getViews(); ?>
                    </h3>
                </li>
            </ul>
         </div>
    </div>
                    
    <div class="span9">
        <div class="row-fluid container-fluid">
            <a href="<?php //echo $this->getLink('show');?> "> 
                <h3>
                    <xsl:value-of select="title" />
                </h3>
            
        </div>
        <div class="row-fluid container-fluid">
            <span>50 Seconds ago, By</span>
            <a href="#"><?php //echo $this->getOwner()->getNick(); ?></a>
        </div>
    </div>
</article>
<hr/>    

</xsl:template>
-->


</xsl:stylesheet>
