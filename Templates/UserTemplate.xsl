<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : UserTemplate.xsl
    Created on : June 25, 2013, 4:25 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!--
    # Template User
    # Mode summary (@todo)
    # Used to show summarize user info (inline)
    -->
    <xsl:template match="user">
        <div class="owner">
            <a href="#">
                <img src="/image/avatar/default.png" class="img-rounded" />
            </a>
            <div class="text-center">
                <h4>
                    <xsl:value-of select="nick" />
                </h4>
            </div>
        </div>
    </xsl:template>
    <!-- ==================================================================== --> 
    
    
    
    <!--
    # Template User
    # Mode summary (@todo)
    # Used to show summarize user info (inline)
    -->
    <xsl:template name="user-login-form">
        <form  method="post">
            <xsl:attribute name="action">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="action">auth</xsl:with-param>
                </xsl:call-template>
            </xsl:attribute>
            
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
