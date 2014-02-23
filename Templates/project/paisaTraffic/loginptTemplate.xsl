<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : loginTemplate.xsl
    Created on : September 30, 2013, 8:24 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- 
        TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="page[title='loginpt']">
        <!-- content -->
        <div class="container-fluid">
            <div class="offset4 span4">
                
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Login</legend>
                        <div class="control-group">
                            <label class="control-label">Login</label>
                            <div class="controls">
                                <input type="text" name="login" value="" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input type="password" name="password" value="" />
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" name="login" value="login" class="btn btn-primary"/>
                        </div>
                    </fieldset>

                </form>

            </div>

        </div>

    </xsl:template>

</xsl:stylesheet>
