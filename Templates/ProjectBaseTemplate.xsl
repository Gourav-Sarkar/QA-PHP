<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : ProjectBaseTemplate.xsl
    Created on : June 25, 2013, 7:43 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    
    <xsl:include  href='QuestionTemplate.xsl'/>
    <xsl:include  href='CommentTemplate.xsl'/>
    <xsl:include  href='AnswerTemplate.xsl'/>
    <xsl:include  href='UserTemplate.xsl'/>
    
    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
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
                    <xsl:apply-templates match="/" />
    
    
                    <script src="jquery/jquery-min.js"></script>
                    <script src="Bootstrap/js/bootstrap.min.js"></script>
                </body>
            </html>
    </xsl:template>

</xsl:stylesheet>
