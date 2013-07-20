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
$(".inline-edit-group .inline-edit-button")
    .click(function(e)
    {
        //Get all field inside it
               
        node=$(e.currentTarget).parents(".inline-edit-group").first();
        console.log(node.html());
        //Hides nodes make it visible if cancel is clicked
        node.hide();
                
        form=jQuery("<form>"
            ,{
                "method":"post"
                ,
                "action":node.get("inline-edit-target")
                    
            }
            );
                
                
        $(node).after(form);
        //console.log($(node).html());
        
        fieldNode=$(node).find(".inline-edit-field");
        
        //console.log(fieldNode.length);
        
        fieldNode.each(function(index,elem)
        {
            //console.log($(elem).data("field-name"));
                
            $(form).append($("<span>").html($(elem).data("field-name")));  
                            
            if($(elem).data("field-type")=="textarea")
            {
                $(form).append($("<textarea>"
                    ,{
                        "name":$(elem).data("field-name")
                    })
                    .text($(elem).text())
                );                 
            }
            else if($(elem).data("field-type")=="text")
            {
                $(form).append($("<input>"
                    ,{
                        "type":$(elem).data("field-type")
                        ,
                        "name":$(elem).data("field-name")
                        ,
                        "value":$(elem).text()
                    })
                );       
            }
           
        }
        );
                
        $(form).append($("<input>"
            ,{
                "type":"button"
                ,
                "name":"Save"
                ,
                "value":"Save"
            })
        .click(function(e)
        {
            alert("process form");
        //e.preventDefault();
        })
        );       
                            
        $(form).append($("<input>"
            ,{
                "type":"button"
                ,
                "name":"Cancel"
                ,
                "value":"Cancel"
            })
        .click(function(e)
        {
            node.show();
            form.hide();
        })
        );       
               
        //Debug
        //console.log($(form).html());
        e.preventDefault();
        
        
    }
    )
