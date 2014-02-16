<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : ProjectBaseTemplate.xsl
    Created on : June 25, 2013, 7:43 AM
    Author     : Gourav Sarkar
    Description:
        It formats xml data to HTML page. All transformation will go through this
        transformation.
        
        Usage: All objects have seperate transformation file. Transformation files
        are named same as class name. To access a SCALAR type property of object
        you need to use <xsl:value-of select="PROPERTY_NAME" /> (consult object API
        for list of available property)
        Currently unavailble property does not generate any error . it just skips
        the filed. [This behaviour could be changed later so that it can show any error]
        All associated REFERENCE type property can not be accessed via 'value-of'. Appropiate
        Template should be applied there. After that thos template can access its SCALAR type data
        as usual. Basically it itereate through each associated object untill it have only 
        scalar type value which can be printed using 'value-of'.
        
         Some static classes will be availble for direct usage in XSLT page. All PHP
         class and function usage may not be optimal (Discremnation needed). Currently
         'Utility' and 'User' Class seem to like a appropiate candidate for XSLT-PHP
         function registering 
         
         @see See Object specific API and XSLT document for any further detailed information
         
         DEVELOPER NOTE
         same form can be used for CREATE and EDIT
         LISTING and READING Dont need form
         DELETE May or may not need form
         
         @ISSUUES Handling unmatched tags for debugging
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" version="1.0">
    <xsl:output method="html"/>
    
    <xsl:template match="pageRoot">
        <xsl:choose>
            <xsl:when  test="current()/@mode='FRAGMENT'">
            <xsl:call-template name="document-fragment"></xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:call-template name="document"></xsl:call-template>
        </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    
    <!--
    # Core page structure
    -->
    <xsl:template name="document">
        <html>
            <head>
                <title>
                    <!-- <xsl:apply-templates match="/" /> -->
                </title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!-- Bootstrap -->
                <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
                <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" />
                <link rel="stylesheet" href="/jquery/bootstrap-editable/css/bootstrap-editable.css" />
                <link href="/Bootstrap/css/bootstrapSwitch.css" rel="stylesheet" media="screen" type="text/css"/>
                <!-- <link rel="stylesheet" href="/work/raju/css/default.css" /> -->

            </head>
            <body>
                <!-- Modal default -->
                    <div id="myModal" class="modal fade hide">
                    
                        <div class="modal-body">
                            <p>One fine body…</p>
                        </div>
                    
                        <div class="modal-footer">
                            <a href="" class="btn" data-dismiss="modal">No</a>
                            <a id="modalAffirm" href="" class="btn btn-primary">Yes</a>
                        </div>
                        
                    </div>
    
                <!-- Header -->
                <xsl:call-template name="pageHeader"></xsl:call-template>
                
                <!--Content -->
                
                <div class="row-fluid">
                    
                    <xsl:choose>
                        <xsl:when test="current()/@static!=''">
                            <xsl:apply-templates select="/" mode="static"/>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:apply-templates />
                        </xsl:otherwise>
                    </xsl:choose>
                </div>
    
                <!-- footer -->
                <xsl:call-template name="pageFooter"></xsl:call-template>
            </body>
        </html>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    <xsl:template name="document-fragment">
        <xsl:apply-templates />
    </xsl:template>
    
    <!--
    # Global Page header
    # It is an application specific header. Which means in one application there
    # would be this header in all pages
    -->
    <xsl:template name="pageHeader">
        
    <div class="navbar navbar-inverse navbar-static-top">

    <div class="row-fluid container-fluid">
        <div class="span4">
            <h1>StackOverflow</h1>
        </div>
        <div class="offset3 span1">
            <div class="btn-group">
                <a class="btn btn-medium btn-info dropdown-toggle" data-toggle="dropdown" href="#">
                    Action
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="?module=adminPanel&amp;action=show">ACP</a></li>
                    <li><a href="?module=question&amp;action=ask">Write Article</a></li>
                    <li><a href="?module=question&amp;action=ask">Ask Question</a></li>
                    <li><a href="?module=question&amp;action=getList">Give Answer</a></li>
                    <li><a href="?module=question&amp;action=ask">Add File</a></li>
                    <li><a href="?module=article&amp;action=getList">Browse article</a></li>
                </ul>
            </div>
             
        </div>
        <div class="span4">
           <xsl:apply-templates select="meta/user" mode="userpanel-inline" />
        </div>

    </div>
    </div>
    <hr/>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
    
    <!--
    # Global Page footer 
    # Just like Global page header. It will be used in all pages in one applicatiomn
    # as a footer
    -->
    <xsl:template name="pageFooter">
        <script src="/jquery/jquery-min.js"></script>
        <script src="/Bootstrap/js/bootstrap.min.js"></script>
        <script src="/Bootstrap/js/bootstrapSwitch.js"></script>
        <script src="/jquery/bootstrap-editable/js/bootstrap-editable.js"></script>
        <script src="js/stackoverflow.js"></script>
    </xsl:template>
    
    <!-- ========================================================================-->
    
    
    <!-- 
    GET link
    @PARAM currentNode Either a node or a string represnting node name
    @PARAM action String 
    -->
    <xsl:template name="getLink">
        
        <xsl:param name="currentNode" select="."/>
        <xsl:param name="action"/>
        <xsl:param name="module"></xsl:param>
        
        <!-- IF currentNode is string Dont add id part and use string directly-->
        <xsl:choose>
            <xsl:when test="string($module)!=''">
                <xsl:text>?module=</xsl:text><xsl:value-of select="$module" />
                <xsl:text>&amp;action=</xsl:text><xsl:value-of select="$action" />
            </xsl:when>
            
            <xsl:otherwise>
                <xsl:text>?module=</xsl:text>
            <xsl:value-of select="local-name($currentNode)" />
            <xsl:text>&amp;</xsl:text><xsl:value-of select="local-name($currentNode)" />=<xsl:value-of select="$currentNode/id" />
            <xsl:text>&amp;action=</xsl:text><xsl:value-of select="$action" />
            
            <xsl:if test="local-name($currentNode/Dependency) ='Dependency'">
                <xsl:for-each select="$currentNode/Dependency/*">
                    <xsl:text>&amp;</xsl:text> <xsl:value-of select="local-name(.)" />=<xsl:value-of select="." />
                </xsl:for-each>
            </xsl:if>
            </xsl:otherwise>
        </xsl:choose>
            
    </xsl:template>
    
    
    
    <!-- Get anchor --> 
    <!--
    <xsl:template name="getAnchor">
        
        <xsl:param name="currentNode" select="."/>
        <xsl:param name="action"/>
           <a>
                <xsl:attribute name="href">
                <xsl:call-template name="getLink">
                    <xsl:with-param name="action">$action</xsl:with-param>
                </xsl:call-template>
                </xsl:attribute>
            <span>$action</span>
            </a>
    </xsl:template>
    -->
    
    <!-- ========================================================================-->
    
    <!-- INLINE form -->
    <xsl:template match="form-inline">
        <form method="post">
            
            <input type="submit" class="btn" />
            <input type="submit" class="btn" />
        </form>
    </xsl:template>
    
    
    
    
    
    <xsl:template match="node()|@*" mode="static">
        <xsl:message>
            <b>Warning 
                <xsl:value-of select="local-name()" />
            </b>
        </xsl:message>
    </xsl:template>
    
    
    <!--
    Basic CRUDE panel
    -->
    <xsl:template name="CRUDpanel" mode="basic">
        <div class="btn-group">
            <xsl:attribute name="data-target-object">
                <xsl:text>questioncomment-</xsl:text>
                <xsl:value-of select="id"></xsl:value-of>
            </xsl:attribute>
            
            <a class="btn btn-mini btn-inline-edit" data-action="edit" data-inline-edit-target=".inline-edit-field-content" >
                        
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="." />
                        <xsl:with-param name="action">edit</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <i class="icon-edit"></i>
            </a>
                    
            <a class="btn btn-mini btn-confirm" data-action="delete" data-btn-msg="Are you really sure to delete this?">
                <xsl:attribute name="href" >
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="." />
                        <xsl:with-param name="action">delete</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <i class="icon-remove"></i>
            </a>
                    
            <a class="btn btn-mini" data-action='flag'>
                <xsl:attribute name="href">
                    <xsl:call-template name="getLink">
                        <xsl:with-param name="currentNode" select="." />
                        <xsl:with-param name="action">flag</xsl:with-param>
                    </xsl:call-template>
                </xsl:attribute>
                <i class="icon-flag"></i>
            </a>
        </div>
    </xsl:template>
    
    
    
    <xsl:template name="genPath">
        <xsl:param name="prevPath"/>
        <xsl:variable name="currPath" select="concat('/',name(),'[',
      count(preceding-sibling::*)+1,']',$prevPath)"/>
        <xsl:for-each select="parent::*">
            <xsl:call-template name="genPath">
                <xsl:with-param name="prevPath" select="$currPath"/>
            </xsl:call-template>
        </xsl:for-each>
        <xsl:if test="not(parent::*)">
            <xsl:value-of select="$currPath"/>      
        </xsl:if>
    </xsl:template>
    
    
    
    <!-- 
    #for handling different meta data viewing use seperate meta xsl sheet
    -->
    <xsl:template match="meta/*">
        <!-- Meta node are not meant be displayed directly -->
    </xsl:template>
    
</xsl:stylesheet>
