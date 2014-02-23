<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : campaignTemplate.xsl
    Created on : September 30, 2013, 8:10 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="campaign">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="offset1 span9">
                    <div class="row-fluid">
                        <!-- -->
                        <div class="span3">
                            <div class="row-fluid">
                                
                            </div>
                        </div>
                        
                        <!-- -->
                        <div class="offset1 span8">
                            <h1>
                                <xsl:value-of select="title" />
                            </h1>
                            <p>
                                <xsl:value-of select="content" />
                            </p>
                            
                            <div class="row-fluid">
                                <xsl:apply-templates select="user" mode="inline-summary"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- campaign stat -->
            <div class="row-fluid">
                <div class="offset1 span9">
                    <a href="#" class="btn btn-large btn-primary">Download</a>
                </div>
            </div>
        </div>
    </xsl:template>
    
    <xsl:template name="campaignform">
        <div class="container-fluid">
            <form method="post" class="form-horizontal">
                <xsl:attribute name="action">
                    <xsl:call-template name="getLink"> 
                        <xsl:with-param name="module">campaign</xsl:with-param>
                        <xsl:with-param name="action">create</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
            
                <fieldset>
                    <legend>Campaign</legend>
                    <div class="control-group">
                        <label class="control-label">Campaign name</label>
                        <div class="controls">
                            <input type="text" name="title" />

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea name="content" ></textarea>

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Expected hit</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" name="target_traffic" /> 
                                <span class="add-on">K</span>
                            </div>

                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">Capital</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">$</span>
                                <input type="text" name="capital" />

                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Expected Age group</label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <select name="agebound[]">
                                    <option value="*">18</option>
                                </select>
                                
                                <span class="add-on">to</span>
                                
                                <select name="agebound[]">
                                    <option value="*">60</option>
                                </select>

                            </div>
                        </div>
                    </div> 
                    
                    <div class="control-group">
                        <label class="control-label">Target Location</label>
                        <div class="controls">
                            <select name="area[]" multiple="multiple">
                                <!-- pull data from flat file -->
                                <option value="*">All</option>
                                <option value="WestBengal">WestBengal</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="control-group">
                        <label class="control-label">Demand Draft</label>
                        <div class="controls">
                            <input type="text" name="ddNum" />
                        </div>
                    </div>
                    
                    
                    <div class="form-actions">
                        <input type="submit" name="start" value="Start" class="btn btn-primary"/>
                    </div>

                </fieldset>
            </form>
        </div>
        
    </xsl:template>
    
    
    
    
  
    
    
    
    <xsl:template match="CampaignStorage">
        <div class="container-fluid">
            <xsl:apply-templates select="campaign" mode="list" />
        </div>
        
    </xsl:template>
    
    
    
    <xsl:template match="campaign" mode="list" >
        <div class="row-fluid">
            <i class="icon icon-envelope"></i>
            
            <xsl:value-of select="id" />
            
            <a>
               
                <xsl:choose>
                    
                    <xsl:when test="parent::node()/@name='userMode'">
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="action">promote</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                    </xsl:when>
                    
                    <xsl:otherwise>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <xsl:with-param name="action">show</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                    </xsl:otherwise>
                    
                </xsl:choose>
                
                <xsl:text>
                    Praesent sagittis, justo id malesuada tincidunt, ipsum leo elementum r
                </xsl:text>
            
            </a>
            <hr/>
        </div>
    </xsl:template>

</xsl:stylesheet>
