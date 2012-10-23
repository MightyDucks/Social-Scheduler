<?php

        function template($templateName, $variables){
                extract($variables, EXTR_PREFIX_ALL, "ss");
                $filepath = "./template/".$templateName.".tpl";
                $templateContents= @file_get_contents($filepath);
                if($templateContents === false){
                        return "";
                }
                eval("\$content = <<<TEMPLATE\r\n
                ".$templateContents." 
\nTEMPLATE;\n");
                unset($templateContents);
                return $content;
        }

?>
