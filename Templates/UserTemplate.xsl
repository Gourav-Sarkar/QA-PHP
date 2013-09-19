<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : UserTemplate.xsl
    Created on : June 25, 2013, 4:25 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->
<!--
# User default view of profile
-->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
    <xsl:output method="html"/>

    <xsl:template match="user" mode="profile">
        <div class="container-fluid">
            <div class="row-fluid span12">
                
                <div class="row-fluid span4 offset1">
                    <div class="row-fluid span2">
                    
                        <img src="/image/avatar/default.png" class="img-rounded" /> 
                    </div>
                    
                    <div class="row-fluid span9 offset1">
                        <div>
                            <b>Name : </b>
                            <span>
                                <xsl:value-of select="name" />
                            </span>
                        </div>
                        <div>
                            <b>nick : </b>
                            <span>
                                <xsl:value-of select="nick" />
                            </span>
                        </div>
                        <div>
                            <b>Email : </b>
                            <span>
                                <xsl:value-of select="email" />
                            </span>
                        </div>
                        
                        <div>
                            <b>Age : </b>
                            <span>
                                <xsl:value-of select="age" />
                            </span>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row-fluid span6">
                    <b>Bio</b>
                    <div>
                        Nunc at velit quis lectus nonummy eleifend. Curabitur eros. Aenean ligula dolor, gravida auctor, auctor et, suscipit in, erat. Sed malesuada, enim ut congue pharetra, massa elit convallis pede, ornare scelerisque libero neque ut neque. In at libero. Curabitur molestie. Sed vel neque. Proin et dolor ac ipsum elementum malesuada. Praesent id orci. Donec hendrerit. In hac habitasse platea dictumst. Aenean sit amet arcu a turpis posuere pretium.

                        Nulla mauris odio, vehicula in, condimentum sit amet,
                    </div>
                </div>
            </div>
        </div>
        <hr/>
    </xsl:template>
    <!--=====================================================================-->
    
    
    
    <!--
    # Template User profile
    -->
    <xsl:template match="userProfile">
        <div class="row-fluid">
            <xsl:apply-templates match="user" mode="profile"/>
        </div>
        
        <div class="row-fluid">
            <ul class="nav nav-tabs">
                <li>
                    <a data-toggle="tab" href="#myQuestion">Questions</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#myAnswer">Answers</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#myArticles">Articles</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#myVotes">Votes</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#myBadges">Badges</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#myReputation">Reputation</a>
                </li>
            </ul>
        </div>
        
        <div class="tab-content" >
            <div class="tab-pane" id="myQuestion">
                Questions    
                <a href="#" id="foo" class="inline-edit" data-type="text" data-title="Enter username">superuser</a>
            </div>
            <div class="tab-pane" id="myAnswer">
                Answers
            </div>
        </div>
    </xsl:template>
    <!--=====================================================================-->
    
    
    
    <!--
    # Template User
    # Mode summary List(@todo)
    # Used to show summarize list (like user searching user list)
    -->
    
    <xsl:template match="user" mode="thumbnail-summary">
        
    </xsl:template>
    <!--=====================================================================-->
    
    


    <!--
    # Template User
    # Mode summary (@todo)
    # Used to show summarize list of essential unique user [property (Used for admininstration view]
    # USAGE NOTE: only insertble to table
    -->
    <xsl:template match="user" mode="table-summary">
        <trow>
            <tdata></tdata>
        </trow>
    </xsl:template>
    <!--=====================================================================-->
    
    
    <!--
    # Template User
    # Mode summary (@todo)
    # Used to show summarize user info (inline)
    -->
    <xsl:template match="user" mode="inline-summary">
        <div class="row-fluid">
            <xsl:choose>
                
                <xsl:when test="string(id)=''">
                    <!-- default User avatar -->
                    <div class="thumbnail span3">
                        <img src="/image/avatar/default.png" class="img-rounded" /> 
                    </div>
                    <div class="text-center">
                        <span>
                            Guest
                        </span>
                    </div>
                </xsl:when> 
                
                <xsl:otherwise>
                    <!-- Registered User avatar -->
                    <div class="thumbnail span3">
                        <a>
                            <xsl:attribute name="href">
                                <xsl:call-template name="getLink">
                                    <xsl:with-param name="action">show</xsl:with-param>
                                </xsl:call-template>
                            </xsl:attribute>
                            <img src="/image/avatar/default.png" class="img-rounded" />
                        </a> 
                        <span>
                            <xsl:value-of select="nick" />
                        </span>
                    </div>
                </xsl:otherwise>
                
            </xsl:choose>
           
        </div>
    </xsl:template>
    <!-- ==================================================================== --> 
    
    
    
    
    <xsl:template match="user" mode="inline-min-summary">
        <xsl:choose>
                
            <xsl:when test="string(id)=''">
                <span class="text-center">
                    Guest
                </span>
            </xsl:when> 
                
            <xsl:otherwise>
                <!-- Registered User avatar -->
                <a>
                    <xsl:attribute name="href">
                        <xsl:call-template name="getLink">
                            <xsl:with-param name="action">show</xsl:with-param>
                        </xsl:call-template>
                    </xsl:attribute>
                        
                        
                    <span class="text-center">
                        <xsl:value-of select="nick" />
                    </span>
                </a> 
            </xsl:otherwise>
                
        </xsl:choose>
    </xsl:template>
    
    
    <!--
    # Template User
    # Mode summary (@todo)
    # Used to show summarize user info (inline)
    -->
    <xsl:template name="user-login-form">
        <form action="/stackoverflow/index.php?module=user&amp;action=auth" method="post">
            
            <span>Nick</span> 
            <input type="text" name="nick" />
            <span>Password</span> 
            <input type="password" name="password" />
            <input class="btn" type="submit" name="login" value="login" />
        </form>
    </xsl:template>
    <!-- ==================================================================== --> 
   
   
    <!--
    # Register form
    -->
    <xsl:template name="user-register-form">
        <form action="/stackoverflow/index.php?module=user&amp;action=create" method="post">
            <div class ='control-group'>
                <span>User Name</span>
                <input type="text" name="nick" />
            </div>
            <div class ='control-group'>
                <span>E-Mail</span>
                <input type="text" name="email" />
            </div>
            <div class ='control-group'>
                <span>Name</span>
                <input type="text" name="name" />
            </div>
            <div class ='control-group'>
                <span>Password</span>
                <input type="text" name="password" />
            </div>
            <div class ='control-group'>
                <input type="submit" name="register" value="register"/>
            </div>
        </form>
    </xsl:template>   
  
    
    

</xsl:stylesheet>
