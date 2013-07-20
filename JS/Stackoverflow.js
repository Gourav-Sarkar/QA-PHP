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
