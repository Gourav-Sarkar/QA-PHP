<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : JournalTemplate.xsl
    Created on : February 13, 2014, 11:26 PM
    Author     : gourav sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="data[@name='JournalApp']">
        <div class="container-fluid">
            <div class="row-fluid">
                
                <!-- main area of journal -->
                <div class="span8">
                    
                    <div class="well">
                        <xsl:call-template name="createForm" />
                    </div>
                    <hr/>
                    <div class="row-fluid">
                        <div class="offset9 span3">
                            <h3>13th may, 2012</h3>
                            <hr/>
                        </div>
                    </div>
                  
                    <xsl:apply-templates select="JournalStorage" />
                </div>
                <!--ends here-->
                
                <div class="span4">
                    <div class="well">
                        <div>
                            <h2>My mood</h2>
                            <hr/>
                        </div>
                        <div>
                            <h2>My </h2>
                            <hr/>
                        </div>
                        <div>
                            <h2>My moments</h2>
                            <hr/>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </xsl:template>
    
    
    
    <xsl:template match="JournalStorage">
        <div>
            <xsl:apply-templates selec="journal" />
        </div>
    </xsl:template>
    
    <xsl:template name="createForm">
        <form method="post" class="block">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="module">journal</xsl:with-param>
                    <xsl:with-param name="action">addEntry</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <textarea name="content" class="span12"></textarea>
            <input type="submit" name="create" value="create"  />
            <hr/>
            <!-- 
            share public
            List of public 
            -->
            <!-- password protected -->
            <!--tag-->
            <!-- Emotions -->
            <!-- attatchment -->
        </form>
    </xsl:template>
    
    
    <xsl:template match="journal">
        
        <div class="container-fluid">
            <p class="lead">10:05 PM</p>
            <p class="lead">
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
                I have written something in journal entry
            </p>
            <hr/>
        </div>
    </xsl:template>

</xsl:stylesheet>
