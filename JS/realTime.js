/*
 * Stream Object
 * 
 */


/*
 * Streaming Continous data
 * It Analyzes document and check the data entry points which should be streamed
 * The target URL is same as current document but action will be different
 */
//Items which can be streamed
var streamObjs=document.getElementsByClassName('stream');
//console.log(streamObjs);
    
    for(var i=0;streamObjs.length>i;++i)
    {   
        streamObj=streamObjs.item(i);
        
        console.log(streamObj.firstChild);
        console.log(streamObj.dataset.stream);
        
        var targetUrl="http://localhost/stackoverflow/index.php?module=" + streamObj.dataset.stream +"&action=stream";
        streamPoll=function(){
                        send(targetUrl,function(data)
                                        {  
                                            //console.log(data.documentElement);
                                            /*
                                             * Add element only if it is not already added
                                             */
                                            ibf=streamObj.insertBefore(data.documentElement,streamObj.firstChild);
                                        }
                            )
                            };
                            
                            setInterval(streamPoll,10000);
        
    }
    
    
    
    
    /*
     * sends a get request
     * @target URL where to send the request
     * @postTask task callback
     */
    function send(target,postTask)
    {
        xhr=new XMLHttpRequest();
        xhr.open('GET',target,true);
        xhr.onreadystatechange=function()
            {
                if(xhr.status==200 && xhr.readyState==4)
                    {
                        console.log('logging');
                        //console.log(xhr.responseXML);
                        postTask(xhr.responseXML);
                    }
            }
        xhr.send();
    }
    
    /*
     * streamListUpdate
     */
    function streamListUpdate(data)
    {
        streamObj.insertBefore(data,streamObj.firstChild);
    }