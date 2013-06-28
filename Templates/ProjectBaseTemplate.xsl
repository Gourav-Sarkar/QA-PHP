<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : ProjectBaseTemplate.xsl
    Created on : June 25, 2013, 7:43 AM
    Author     : Gourav Sarkar
    Description:
        It formats xml data to HTML page. All transformation will go through this
        transformation
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    
    <xsl:include  href='QuestionTemplate.xsl'/>
    <xsl:include  href='UserTemplate.xsl'/>
    <xsl:include  href='AnswerTemplate.xsl'/>
    <xsl:include  href='commentTemplate.xsl'/>
    <xsl:include  href='tagTemplate.xsl'/>
    
    <!-- 
    # Core page structure
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>
                    <!-- <xsl:apply-templates match="/" /> -->
                </title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!-- Bootstrap -->
                <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
            </head>
            <body>
                <!-- Header -->
                <section class="row-fluid">
                    <xsl:apply-templates />
                </section>
    
                <!-- footer -->
                <script src="jquery/jquery-min.js"></script>
                <script src="Bootstrap/js/bootstrap.min.js"></script>
            </body>
        </html>
    </xsl:template>
    <!-- ========================================================================-->
    
    
    
    <!--
    # Global Page header
    # It is an application specific header. Which means in one application there
    # would be this header in all pages
    -->
    <xsl:template match="pageHeader">
        
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
                    <li><a href="?module=question&amp;action=ask">Write Article</a></li>
                    <li><a href="?module=question&amp;action=ask">Ask Question</a></li>
                    <li><a href="?module=question&amp;action=ask">Give Answer</a></li>
                    <li><a href="?module=question&amp;action=ask">Add File</a></li>
                </ul>

                <div class="switch switch-small">
            <input type="checkbox" />
        </div>
            </div>
             
        </div>
        <div class="span4">
            <ul class="nav">
                <!-- <?php if (User::getActiveUser()): ?> -->
                    <li><img src='/image/avatar/avatar.jpg' style="width:40px;height:40px;" class="img-polaroid"/></li>
                    <li>
                        <a data-toggle="modal" href="#">nick</a>
                    </li>
                <!-- <?php else: ?> -->
                    <li><a href="#hover">Login</a></li>
                <!-- <?php endif; ?> -->

                <li><a href='#'><i class="icon-globe"></i></a></li>
                <li><a href='#'><i class="icon-bell"></i></a></li>
                <li><a href='#'><i class="icon-envelope"></i></a></li>
            </ul>
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
    <xsl:template match="pageFooter">
        <footer class="row-fluid">

        </footer>
        <script src="/jquery/jquery-min.js"></script>
        <script src="/Bootstrap/js/bootstrap.min.js"></script>
        <script src="/Bootstrap/js/bootstrapSwitch.js"></script>
        <script src="js/realtime.js"></script>
    </xsl:template>
    
    <!-- ========================================================================-->

</xsl:stylesheet>
