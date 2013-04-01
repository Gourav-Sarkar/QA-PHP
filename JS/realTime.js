/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
body=document.getElementsByTagName("body")[0];
console.log(body);

body.addEventListener("click",function(e)
                                 {
                                  
                                   //e.target.
                                   console.log( e.target.parentNode);
                                   /*
                                    *target node
                                    * If it is anchor or it is image node but its parent is anchor/button
                                   */
                                  
                                   if(target=e.target['class']=="btn-group")
                                   {
                                        //console.log("hello");
                                        console.log(e.target.getAttribute("href"));
                                        
                                        var location=e.target.getAttribute("href");
                                        e.preventDefault();
                                        send(location)
                                        return false;
                                   }
                                 }
                               ,true
                      );

/*
 * Well suited for buttons
 * Synced so pressing button twice wont make any difference
 */
function send(location)
{
    var ajax=new XMLHttpRequest();
    ajax.open("GET",location,false);
    ajax.setRequestHeader("X_REQUESTED_WITH", "ajax");
    ajax.send();
    
    console.log(ajax.responseText);
}

function inlineEdit()
{
    document.getElementById(id);
}