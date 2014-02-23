<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : AboutTemplate.xsl
    Created on : August 30, 2013, 11:40 AM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="page[title='contact']">
         
        <div id="template">
            <div class="row-fluid control-panel btn-group">
                <form action="/stackoverflow/index.php" method="post">
                    <textarea class="input-block-level"></textarea>
                    <div class=" row-fluid">
                        <input class=" btn btn-info" type='submit' name="save" value="save" />
                        <button class="btn" name="cancel" value="cancel" >Cancel</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row-fluid header">
            <!-- Quick admin panel -->
            <div class="row-fluid" id="adminPanel">
                <a href="#" class="btn btn-large btn-success" data-action="adminMode">Edit Mode</a>
            </div>


            <!-- Site Title, Caption ,navBar-->
            <div class="row-fluid">
                <div id="title" class="offset1 span4">
                    <h1 class="inline-element">
                        <span>TimEver</span>
                    </h1>
                    <p class="inline-element">
                        <span>Your personal tour guide</span>
                    </p>
                </div>

                <div class="offset1 span6 mod-navbar">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Partners</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">location</a>
                        </li>
                        <li>
                            <button class="btn btn-success" >Member</button>
                        </li>
                    </ul>
                </div>
            </div>

            <br/>



            <div class="row-fluid">
                <div class="encloser offset1 span10">


                    <div class="container-fluid">
                        <!--two clumn -->
                        <form class="form-horizontal" action="" >
                            <legend>Contact Us</legend>
                            <div class="control-group">
                                <label class="control-label">Name:</label>
                                <div class="controls">
                                    <input type="text" value="" required="required" pattern="[\w](3,20)"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">E-Mail:</label>
                                <div class="controls">
                                    <input type="email" name="email" required="required"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Subject</label>
                                <div class="controls">
                                    <input type="text" name="subject" required="required"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Message</label>
                                <div class="controls">
                                    <textarea name="message" required="required"></textarea>
                                </div>
                                <span class="help-inline">
                                    Feel free to ask any query
                                </span>
                            </div>
                            
                            <div class="form-actions">
                                <input class="btn btn-primary" type="submit" name="send" value="send" />
                            </div>
                        </form>

                    </div>


                </div>


            </div>

            <!-- footer -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span4">
                        <p class="datas">Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                        </p>
                    </div>
                    <div class="span4">
                        <p class="datas">Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                        </p>
                    </div>
                    <div class="span4">
                        <p class="data">Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                            sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                        </p>
                    </div>

                </div>

                <div class="row-fluid">
                    <p>Copy Right Reserved</p>
                </div>


            </div>


        </div>
    </xsl:template>

</xsl:stylesheet>