<?php

        function template($templateName, $variables){
                extract($variables, EXTR_PREFIX_ALL, "ss_");
                $guestpage = file_get_contents("./template/guestpage.tpl");
                eval("\$content = \"".$guestpage."\";");
                unset($guestpage);
        }

?>
