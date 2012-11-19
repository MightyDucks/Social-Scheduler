<?php

        class facebookhelper {
                public static function getFriends(&$fb){
                        if($fb->getUser() == 0){
                                return null;
                        }
                        $friendArr = array();
                        $offset = 500;
                        $currOffset = 0;
                        do{
                                $friendPart = $fb->api("me/friends?limit=$currOffset");

                                for($i = 0; $i < count($friendPart['data']); $i++){
                                        $friendArr[] = array('name' => $friendPart['data'][$i]['name'], 'id' => $friendPart['data'][$i]['id']);
                                }
                                $currOffset += $offset;
                        }while(count($friendPart['data']) == $offset);
                        return $friendArr;
                }
        }

?>
