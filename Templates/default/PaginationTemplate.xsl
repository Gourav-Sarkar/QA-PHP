<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : PaginationTemplate.xsl
    Created on : February 12, 2014, 8:28 PM
    Author     : gourav sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    
    <!--Default pagination -->
    <xsl:template match="pagination">
        <div class="pagination">
            <ul> 
                <li>
                    <xsl:if test="number(page)=1">
                        <xsl:attribute name="class">active</xsl:attribute>
                    </xsl:if>
                    <a>
                        <xsl:attribute name="href">
                            <!-- @todo should be replaced with specialised link formater for content storage -->
                            <xsl:call-template name="getLink">
                                <!-- 
                                # could be optimised
                                # Pagination usually used in ContentStorage
                                # First parent is property, second parent is object it self
                                -->
                                <xsl:with-param name="module" select="../../storageType"></xsl:with-param>
                                <xsl:with-param name="action">getList</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <xsl:text>Prev</xsl:text>
                    </a>
                </li>
                <li>
                    
                    <xsl:if test="page">
                        <xsl:attribute name="class">active</xsl:attribute>
                    </xsl:if>
                    <a href="#">1</a>
                </li> 
                <li>
                    <xsl:if test="number(page)=number(totalpage)">
                        <xsl:attribute name="class">disabled</xsl:attribute> 
                        <a href="#">next</a> 
                    </xsl:if>
                     <a>
                        <xsl:attribute name="href">
                            <xsl:call-template name="getLink">
                                <!-- 
                                # could be optimised
                                # Pagination usually used in ContentStorage
                                # First parent is property, second parent is object it self
                                -->
                                <xsl:with-param name="module" select="../../storageType"></xsl:with-param>
                                <xsl:with-param name="action">getList</xsl:with-param>
                            </xsl:call-template>
                        </xsl:attribute>
                        <xsl:text>next</xsl:text>
                    </a>
                </li>
            </ul>
        </div>
    </xsl:template>

</xsl:stylesheet>
