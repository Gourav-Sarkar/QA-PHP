<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : JournalTemplate.xsl
    Created on : February 13, 2014, 11:26 PM
    Author     : gourav sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
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
                            <h3>
                                <xsl:value-of select="php:function('date','d F , Y')"/>
                            </h3>
                            <hr/>
                        </div>
                    </div>
                  
                    <xsl:apply-templates select="JournalStorage" />
                </div>
                <!--ends here-->
                
                <div class="span4">
                    <div class="well">
                        <div>
                            <h2>My Statistics</h2>
                            <hr/>
                        </div>
                        <div>
                            <h2>My Moood</h2>
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
        <div id="JournalEntryStorage">
            <xsl:apply-templates select="journal" />
        </div>
    </xsl:template>
    
    <xsl:template name="createForm">
        <!-- Unique attribute -->
        <form id="JournalEntryForm" method="post" class="block">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="module">journal</xsl:with-param>
                    <xsl:with-param name="action">addEntry</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
            <div class="row-fluid">
                <p class="lead">
                    <i class="icon-calendar"/>
                    <xsl:value-of select="php:function('date','h:i A')" />
                </p>
                <hr/>
            </div>
            
            <textarea name="content" class="span12"></textarea>
            <!-- Emotions -->
            <span>Emotion</span>
            <input type="text" name="emotion" value=""  />
            <span>Tag</span>
            <input type="text" name="tag" value=""  />
            <span>Passkey</span>
            <input type="text" name="passkey" value=""  />
            
            <span>Privacy</span>
            <select name="privacy">
                <option value="">Me</option>
                <option value="">Friends</option>
                <option value="">Public</option>    
            </select>
            
            <span>Share</span>
            <span>Facebook</span>
            <input type="checkbox" name="share[]" value="Facebook" />
            <span>Twitter</span>
            <input type="checkbox" name="share[]" value="Twitter" />
            <span>Google+</span>
            <input type="checkbox" name="share[]" value="Googleplus" />
            <span>Email</span>
            <input type="checkbox" name="share[]" value="Email" />
                
            <input type="submit" data-loading-text="Commenting.." data-holder="#JournalEntryStorage" class="btn realTime" name="create" value="create" />

            <hr/>
            <!-- 
            share public
            List of public 
            -->
            <!-- -->
            <!-- password protected -->
            <!--tag-->
        </form>
    </xsl:template>
    
    
    <xsl:template match="journal">
        
        <div class="container-fluid">
            <p class="lead"> 
                <xsl:value-of select="php:function('date','h:i A , l',number(time))" />
            </p>
            <p class="lead">
                <xsl:value-of select="content" />
            </p>
            <hr/>
        </div>
    </xsl:template>

</xsl:stylesheet>
