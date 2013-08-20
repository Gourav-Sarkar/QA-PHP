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
$(".inline-edit-button")
    .click(function(e)
    {
        //Get group name
        groupName=$(e.currentTarget).data("inline-edit-group");
        //console.log(groupName);
        
        //clone node and create form
         inlineform=$(".inline-edit-group-origin"+groupName).clone();
         $(".inline-edit-group-origin"+groupName).hide();
        
        //Get all element which have same group name
        $(".inline-edit-group-"+groupName)
        .each(function(index,elem)
        {
            type=$(elem).data("field-type");
                
            /*
             * if type is textarea render one
             * other wise render input box
             */    
            if(type=="textarea")
            {
                $(elem)
                .replaceWith($("<textarea>",{
                    "name":$(elem).data("field-name")
                }
                ).text($(elem).text())
                    );
            }
            else if(type=="text")
            {
                $(elem)
                .replaceWith($("<input>",{
                    "type":"text"
                    ,
                    "name":$(elem).data("field-name")
                    ,
                    "value":$(elem).text()
                }
                )
                );
            }
                
        }
        );
        
        e.preventDefault();
        
        
    }
    )
        
        
        
        /*
         * Real time commenting
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
                var form=$(e.currentTarget).data("form");
                //Attribute of target location in form
                var url=$(form).attr("action");
                
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
                            //Reset loading mode
                            $(e.currentTarget).button("reset");
                        }
                      );
                
                e.preventDefault();
            }
        )
