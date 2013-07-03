<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : ArticleTemplate.xsl
    Created on : June 29, 2013, 12:02 PM
    Author     : Gourav Sarkar
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <div class="container-fluid row-fluid">

            <!--Article heading -->
            <div class="row-fluid">
                <div class="offset1 span10">
                    <div class='page-header'>
                        <h1>
                            Heading of the article
                            <small>Caption of the artivle if avilble</small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row-fluid">

                <!--Content Info -->
                <div class="span1">
                    <div class="text-center">
                        <img src="http://127.0.0.1/image/icon/ui/arrow-up-64.png" />
                        <h1>19k</h1>
                        <img src="http://127.0.0.1/image/icon/ui/arrow-down-64.png" />
                        <img src="http://127.0.0.1/image/icon/social/facebook.png" />
                        <img src="http://127.0.0.1/image/icon/social/twitter.png" />
                        <img src="http://127.0.0.1/image/icon/social/googleplus_red.png" />
                    </div>
                </div>

                <!--Content Area -->
                <div class="span7">
                    <p class="lead">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit.

                        Nunc at velit quis lectus nonummy eleifend. Curabitur eros. Aenean ligula dolor, gravida auctor, auctor et, suscipit in, erat. Sed malesuada, enim ut congue pharetra, massa elit convallis pede, ornare scelerisque libero neque ut neque. In at libero. Curabitur molestie. Sed vel neque. Proin et dolor ac ipsum elementum malesuada. Praesent id orci. Donec hendrerit. In hac habitasse platea dictumst. Aenean sit amet arcu a turpis posuere pretium.

                        Nulla mauris odio, vehicula in, condimentum sit amet, tempus id, metus. Donec at nisi sit amet felis blandit posuere. Aliquam erat volutpat. Cras lobortis orci in quam porttitor cursus. Aenean dignissim. Curabitur facilisis sem at nisi laoreet placerat. Duis sed ipsum ac nibh mattis feugiat. Proin sed purus. Vivamus lectus ipsum, rhoncus sed, scelerisque sit amet, ultrices in, dolor. Aliquam vel magna non nunc ornare bibendum. Sed libero. Maecenas at est. Vivamus ornare, felis et luctus dapibus, lacus leo convallis diam, eget dapibus augue arcu eget arcu.

                        Fusce auctor, metus eu ultricies vulputate, sapien nibh faucibus ligula, eget sollicitudin augue risus et dolor. Aenean pellentesque, tortor in cursus mattis, ante diam malesuada ligula, ac vestibulum neque turpis ut enim. Cras ornare. Proin ac nisi. Praesent laoreet ante tempor urna. In imperdiet. Nam ut metus et orci fermentum nonummy. Cras vel nunc. Donec feugiat neque eget purus. Quisque rhoncus. Phasellus tempus massa aliquet urna. Integer fringilla quam eget dolor. Curabitur mattis. Aliquam ac lacus. In congue, odio ut tristique adipiscing, diam leo fermentum ipsum, nec sollicitudin dui quam et tortor. Proin id neque ac pede egestas lacinia. Curabitur non odio.

                        Nullam porta urna quis mauris. Aliquam erat volutpat. Donec scelerisque quam vitae est. Aenean vitae diam at erat pellentesque condimentum. Duis pulvinar nisl sed orci. Vivamus turpis nisi, volutpat in, placerat et, pharetra nec, eros. Suspendisse tellus metus, sodales non, venenatis a, ultrices auctor, erat. In ut leo nec elit mattis pellentesque. Sed eros elit, cursus accumsan, sollicitudin a, iaculis quis, diam. Pellentesque fermentum, pede a nonummy varius, ligula velit laoreet erat, et lacinia nibh nulla sit amet nunc. Suspendisse at turpis quis augue pellentesque pretium. Nunc condimentum elit semper felis.

                        Duis imperdiet diam pharetra nisi. Fusce accumsan. Fusce adipiscing, felis non ornare egestas, risus elit placerat mauris, in mollis ante erat quis nisi. Quisque sed ipsum. Nulla facilisi. Donec arcu erat, sodales quis, cursus eget, posuere eget, tellus. Vestibulum eu risus. Curabitur adipiscing, odio in pretium feugiat, nulla magna vehicula lorem, at placerat tortor nisl eget velit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse mollis fermentum massa.

                        Pellentesque vulputate bibendum lorem. Nunc lobortis. Vestibulum aliquam fringilla mauris. Vivamus dolor est, eleifend id, varius id, suscipit at, felis. Nulla mattis cursus neque. Nam lobortis mi vitae sem vehicula accumsan. Integer vitae odio in felis facilisis cursus. Sed bibendum mauris a justo. Integer ut mi. Maecenas quis mauris. Integer non lectus at magna elementum posuere.

                        Vestibulum et urna. Aliquam pretium, urna nec dapibus vehicula, tellus nulla pretium dolor, vitae gravida massa erat non mauris. Aenean non erat. Nam non leo. Fusce sed erat. Maecenas id odio vehicula eros elementum congue. Donec feugiat orci in lectus. Vestibulum mattis justo eget justo. Aenean eu nisl. Phasellus non ipsum non nisi fringilla cursus. Integer condimentum porta arcu. Quisque faucibus. Quisque mattis, tellus eu auctor pulvinar, nulla dui sagittis elit, vel ultricies mauris lectus tempus magna. Donec auctor facilisis lorem. Ut pharetra pellentesque nulla. Phasellus libero metus, commodo sit amet, ullamcorper sit amet, euismod et, tortor. Sed nec arcu et felis vulputate venenatis.

                        Praesent sagittis, justo id malesuada tincidunt, ipsum leo elementum risus, at pulvinar ante urna et sem. Proin posuere metus sed tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Vivamus eros. Mauris tincidunt congue nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean porttitor ante vitae ligula. Duis mattis diam id mi. Nulla sed mi ut elit bibendum pharetra. Aenean eu nunc. Integer lacus sem, feugiat nec, lacinia non, adipiscing sit amet, odio. Etiam odio. Maecenas placerat placerat libero. Donec ultricies erat vitae tellus volutpat fringilla. Phasellus urna est, tincidunt at, porta vitae, viverra ut, lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Cras non odio viverra libero eleifend sagittis.

                        Aliquam dictum lectus. Morbi pulvinar lacus et diam. Maecenas nunc massa, ultrices eget, nonummy nec, condimentum et, risus. Proin convallis dapibus nisi. Maecenas porta, augue quis porttitor consectetuer, felis odio blandit orci, in elementum pede lacus egestas mi. Etiam auctor, mauris eget lobortis blandit, tellus nisl convallis turpis, non auctor ante nisl eget eros. Donec rhoncus purus nec nunc. Suspendisse eros. Fusce et nisl. Morbi condimentum enim sed ipsum. Aliquam mi. Duis sit amet sapien. Nullam sed purus. Aliquam fringilla sagittis neque. Fusce eget risus. Donec bibendum, purus id bibendum sagittis, mauris est tincidunt risus, nec fermentum diam velit pellentesque dolor. Vestibulum quis libero eget arcu vestibulum auctor. Donec sit amet erat. Maecenas sit amet ipsum. Pellentesque sapien pede, mollis a, consectetuer sit amet, consectetuer nec, tellus.

                        Duis ac est rutrum urna venenatis auctor. Sed quis ante. Nullam urna lorem, tempus 
                    </p>
                </div>

                <!-- User profile -->
                <div class="span4">
                    <div class="row-fluid">
                        <div class="offset1 span2">
                            <img class='img-rounded img-polaroid' src="http://127.0.0.1/image/avatar/avatar.jpg" />
                        </div>
                        <div class="offset1 span8">
                            Profile key unfo
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="offset1">
                            <p>User bio In short</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </xsl:template>

</xsl:stylesheet>
