/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * InLine edit
 * inline-edit-group
 * inline-edit-field
 * data-inline-edit-target
 * data-field-name
 * data-field-type (textarea/password/text)
 * 
 * IF XSLT processing is involved (PREFERRED) then create a xml node and 
 * transform it into a form
 * 
 * <inline-form target="@">
 *  <inline-form-field type=@ name=@>
 * buttons
 * </inline-form>
 * 
 */
/*
        
        
        
/*
* [VERIFIED]
* Real time content adding
*/
$("form input[type='submit']")
    .click(
        function(e)
        {
            console.log(e);
            //Target of the button which is being clicked
            var  target= $(e.currentTarget).data("target");
            //Clicked button data attribute which points to holder which is a unique id
            //Holder will store the resulatant data
            var holderTarget=$(e.currentTarget).data("holder");
                
            //form where the button has been pressed and which is needed to be submited
            var form=$(e.currentTarget).closest("form");
            //Attribute of target location in form
            var url=$(form).attr("action");
            //console.log(url);
                
            //Toggle loading mode
            $(e.currentTarget).button("loading");
                
            //@Debaug statrements
            console.log(target);
            console.log(holderTarget);
            console.log($(form).html());
            console.log(url);
            console.log($(form).serialize());
                
            $.post(url
                ,$(form).serialize()
                ,function(data)
                {
                    //get the data and append it in holder
                    $(holderTarget).append(data);
                    //@debug data
                    console.log('data',data);
                    //Reset loading mode
                    $(e.currentTarget).button("reset");
                }
                );
                
            e.preventDefault();
        }
        )
            
            

/*
             * General Modal dialouge
             * Niche delete content
             */
$("body")
    .on("click"
        ,".btn-confirm"
        ,function(e)
        {
            var targetNode=$(e.currentTarget);
                            
            //Make the original data hide
            //var btn=$(e.currentTarget).closest(".btn");
            msgBody=targetNode.data('btn-msg');
                            
                            
            $('#myModal .modal-body p').html(msgBody);
            $('#myModal').modal('toggle');
                                    
            $('#modalAffirm').click(
                function(e)
                {
                    $.get(targetNode.attr('href') //should use post
                        ,null
                        ,function(data)
                        {
                            $('#myModal .modal-body p').html(data);
                            var targetID=targetNode.closest('.btn-group').data('target-object');
                            $("#"+targetID).remove();
                            console.log(data);
                            $('#myModal').modal('toggle');
                        }
                        )
                        
                    e.preventDefault();
                }
                );
                
            e.preventDefault();
        }
                
        );
   
/*
    * Ajax creation of content
    */
   
        
//$.fn.editable.defaults.toggle="manual";
$.fn.editable.defaults.mode="inline";
        
/*
 *[Verified]
 * inline edit
 */      
$("body").on(
    "click"
    ,".btn-inline-edit" //marker
    ,function(e)
    {
        console.log("edit");
        $.fn.editable.defaults.toggle="manual";
        
        //get Target id
        var target=$(e.currentTarget).closest(".btn-group").data("target-object");  //marker
        
        //create anchor node
        /*
         * Click on document closes the popup. so when click is occured in any dom
         * element it will popogate to upper node and when it reaches the body
         * it will close the popup immidtately. so no popup will be shown there
         * 
         * In case of non 'manual' option it handles it internally
         */
        e.stopPropagation();
        
        $("#"+target).find(".inline-edit").editable('toggle');      //marker
        
        e.preventDefault();
    }
    );
        
$(document).ready(function() {
    var url="index.php?module=adminPanel&action=update";
    
    //Inline edit setting
    $('.inline-edit').editable();
    console.log("Edit mode");
    
    //In line switch setting
    $(".switch").on("switch-change"
        ,function(e,data)
        {
            console.log("switch");
        }

        );
});   