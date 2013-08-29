<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : TimeEverTemplate.xsl
    Created on : August 25, 2013, 8:59 PM
    Author     : Gourav Sarkar
    Description:
        
Each page will have different transformation
Page component can be styled alone
Page component can be styled together using group
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <!--
    <xsl:template match="PageComponentStorage/pagecomponent">
        <div><h1>
                <xsl:value-of select="title" />
            </h1>
             <span>
                <xsl:value-of select="content" />
             </span>
        </div>
    </xsl:template>
    -->
    <xsl:template match="page[title='home']">
         
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
                        <li><a href="#">About</a></li>
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">location</a></li>
                        <li>
                            <button class="btn btn-success" >Member</button></li>
                    </ul>
                </div>
            </div>

            <br/>
            <!-- Heighlight text -->
            <div class="row-fluid ">
                <div class="offset6 span5 highlightNote data-group">
                    <div class="row-fluid inline-element">
                        <h1>
                            <span>Attention please</span>
                        </h1>
                    </div>


                    <div class="row-fluid inline-element">

                        <p class="span12 content lead" data-name="showStopper">
                            <span>
                                sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit posuere. Aliquam erat volutpat. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit posuere. Aliquam erat volutpat. C

                            </span> 
                        </p>
                    </div>
                </div>
            </div>



            <div class="row-fluid">
                <div class="encloser offset1 span10">


                    <div class="container-fluid">
                        <!--two clumn -->
                        <div class="row-fluid">
                            <div class="offset1 span6">
                                <h2 class="data">Firs grade attention</h2>
                                <p class="data">
                                    Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                </p>
                            </div>
                            <div class="offset1 span3">
                                <h2 class="data">Suppliment first grade attention</h2>
                                <p class="data">
                                    Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, lis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit

                                </p>
                            </div>

                        </div> 
                    </div>

                    <!-- Eye break single column -->
                    <div class="row-fluid">
                        <div class=" mod-eye-breaker">
                            <div class="container-fluid">
                                <h2 class="inline-element">
                                    <span>Second grade attention</span>
                                </h2>
                                <p class="inline-element">
                                    <span>Foo bar bafsit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                        sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                        sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                        sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                        sit amet, tempus id, metus. Donec at nisi sit amet felis. Co, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit
                                    </span>
                                </p>
                            </div>
                        </div>

                    </div>

                    <!--
                    three column less important things
                    
                    -->
                    <div class="row-fluid data-group">
                        <div class="data-group-item offset1 span3">
                            <h2 class="data">Why We?</h2>
                            <p class="data">
                                Foo bar baf
                            </p>
                        </div>
                        <div class="data-group-item offset1 span3">
                            <h2 class="data">What other is saying?</h2>
                            <p class="data">
                                Foo bar baf
                            </p>
                        </div>
                        <div class="data-group-item offset1 span3">
                            <h2 class="data">What other is saying?</h2>
                            <p class="data">
                                Foo bar baf
                            </p>
                        </div>

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
