    <!DOCTYPE html>
    <html>
    <head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header class="row-fluid container-fluid">
            <h1>Admin Panel</h1>
            <div>
                <?php 
                /*
                //May need to remove use of globals
                $resource=new Resource();
                $resource->setController('question');
                Resource::getAavailableAction($resource); 
                 * 
                 */
                ?>
            </div>
        </header>
        
        <section class="row-fluid container-fluid">
            <div class="span2">
                <!-- List of all modules -->
                <ul class="nav nav-tabs nav-stacked">
                    <li><a href="#core" data-toggle="tab"><h3 class="text-center">Core</h3></a></li>
                    <li><a href="#question" data-toggle="tab"><h3 class="text-center">Question</h3></a></li>
                    <li><a href="#answer" data-toggle="tab"><h3 class="text-center">Answer</h3></a></li>
                    <li><a href="#comment" data-toggle="tab"><h3 class="text-center">Comment</h3></a></li>
                    <li><a href="#tag" data-toggle="tab"><h3 class="text-center">tag</h3></a></li>
                    <li><a href="#role" data-toggle="tab"><h3 class="text-center">Role</h3></a></li>
                    <li><a href="#user" data-toggle="tab"><h3 class="text-center">User</h3></a></li>
                    <li><a href="#reputation" data-toggle="tab"><h3 class="text-center">Reputation</h3></a></li>
                    <li><a href="#flag" data-toggle="tab"><h3 class="text-center">Flags</h3></a></li>
                    <li><a href="#server" data-toggle="tab"><h3 class="text-center">Server</h3></a></li>
                    <li><a href="#statistic" data-toggle="tab"><h3 class="text-center">Statistic</h3></a></li>
                </ul>
            </div>
            
            <!-- TAB CONTENT -->
            <div class="span10">
                <div class="tab-content">
                    <div class="tab-pane" id="core">
                        <pre>
                        * Reset session
                        </pre>
                    </div>
                    <div class="tab-pane" id="question">question</div>
                    <div class="tab-pane" id="answer">answer</div>
                    <div class="tab-pane" id="comment">comment</div>
                    <div class="tab-pane" id="tag">
                        Tag can be created edited deleted
                        Tagged question can be show here
                    </div>
                    <div class="tab-pane" id="user">
                        user will have list of user. admin can filter to get certain user. all user related controll will be available
                        Admin can create edit delete user
                    </div>
                    <div class="tab-pane" id="reputation">
                        Reputation Will have modules and the reputation points that should be generated
                    </div>
                    <div class="tab-pane" id="flag">Flag</div>
                    <div class="tab-pane" id="server">Server</div>
                    <div class="tab-pane" id="statistic">Statistic</div>
                    <div class="tab-pane active" id="role">Role</div>
                    
                </div>
            </div>
        </section>
        
        <footer class="row-fluid">
        
        </footer>
	
    <script src="/jquery/jquery-min.js" type="text/javascript"></script>
    <script src="/Bootstrap/js/bootstrap.js" type="text/javascript"></script>
    </body>
    </html>