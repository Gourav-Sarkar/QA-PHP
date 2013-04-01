<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface RenderbleInterface {
    //put your code here
    public function Render(Template $template);
    public function getLink($action);
            
}

?>
